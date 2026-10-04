<?php

namespace App\Services;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Sanitize original filename:
     * - Convert uppercase to lowercase
     * - Convert spaces and special characters to hyphens '-'
     * - Set target extension (default: webp)
     */
    public static function sanitizeFilename(string $originalFilename, string $extension = 'webp'): string
    {
        $baseName = pathinfo($originalFilename, PATHINFO_FILENAME);
        $slug = Str::slug(Str::lower($baseName), '-');

        if (blank($slug)) {
            $slug = 'image-'.Str::lower(Str::random(6));
        }

        $extension = Str::lower(ltrim($extension, '.'));

        return "{$slug}.{$extension}";
    }

    /**
     * Convert an image file to WebP format with alpha channel preservation.
     */
    public static function convertToWebp(string $sourcePath, int $quality = 85): ?string
    {
        if (! file_exists($sourcePath)) {
            return null;
        }

        $sourceContent = @file_get_contents($sourcePath);
        if ($sourceContent === false || $sourceContent === '') {
            return null;
        }

        $image = @imagecreatefromstring($sourceContent);
        if ($image === false) {
            return null;
        }

        // Preserve alpha transparency for PNGs and transparent images
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        $tempPath = tempnam(sys_get_temp_dir(), 'webp_').'.webp';
        $success = imagewebp($image, $tempPath, $quality);
        imagedestroy($image);

        if (! $success || ! file_exists($tempPath)) {
            return null;
        }

        return $tempPath;
    }

    /**
     * Check if the uploaded file is an image.
     */
    public static function isImageFile(UploadedFile $file): bool
    {
        $mime = $file->getMimeType() ?? '';
        $ext = strtolower($file->getClientOriginalExtension());

        return str_starts_with($mime, 'image/') || in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'avif']);
    }

    /**
     * Configure a Filament FileUpload component to:
     * 1. Save uploaded image in its lowercased, hyphenated original name
     * 2. Convert uploaded image to WebP format
     * 3. Store on the public disk with public visibility
     */
    public static function configure(FileUpload $component): FileUpload
    {
        return $component
            ->disk('public')
            ->visibility('public')
            ->getUploadedFileNameForStorageUsing(function (BaseFileUpload $component, UploadedFile $file): string {
                $isImage = static::isImageFile($file);
                $ext = $isImage ? 'webp' : strtolower($file->getClientOriginalExtension());

                return static::sanitizeFilename($file->getClientOriginalName(), $ext);
            })
            ->saveUploadedFileUsing(function (BaseFileUpload $component, UploadedFile $file): ?string {
                return static::saveUploadedFileAsWebp($component, $file);
            })
            ->getUploadedFileUsing(function (BaseFileUpload $component, string $file, string|array|null $storedFileNames): ?array {
                return static::getUploadedFileData($component, $file, $storedFileNames);
            });
    }

    /**
     * Retrieve uploaded file metadata and same-origin URL for Filament FileUpload component.
     *
     * @param  string | array<string, string> | null  $storedFileNames
     * @return array{name: string, size: int, type: ?string, url: string} | null
     */
    public static function getUploadedFileData(BaseFileUpload $component, string $file, string|array|null $storedFileNames = null): ?array
    {
        $diskName = $component->getDiskName() ?: 'public';
        $disk = Storage::disk($diskName);

        if (! $disk->exists($file)) {
            return null;
        }

        $size = 0;
        $type = null;

        try {
            $size = (int) $disk->size($file);
        } catch (\Throwable) {
            $size = 0;
        }

        try {
            $type = $disk->mimeType($file);
        } catch (\Throwable) {
            $type = null;
        }

        $url = ($diskName === 'public' || $diskName === 'local')
            ? '/storage/'.ltrim($file, '/')
            : $disk->url($file);

        $name = ($component->isMultiple() ? ($storedFileNames[$file] ?? null) : $storedFileNames) ?? basename($file);

        return [
            'name' => $name,
            'size' => $size,
            'type' => $type,
            'url' => Str::sanitizeUrl($url),
        ];
    }

    /**
     * Perform the actual save and WebP conversion for the uploaded file.
     */
    public static function saveUploadedFileAsWebp(BaseFileUpload $component, UploadedFile $file): ?string
    {
        $diskName = $component->getDiskName() ?: 'public';
        $disk = Storage::disk($diskName);
        $directory = trim($component->getDirectory() ?? '', '/');

        $isImage = static::isImageFile($file);
        $extension = $isImage ? 'webp' : strtolower($file->getClientOriginalExtension());
        $baseFilename = static::sanitizeFilename($file->getClientOriginalName(), $extension);

        // Avoid overwriting existing files: append -1, -2 if needed
        $nameOnly = pathinfo($baseFilename, PATHINFO_FILENAME);
        $filename = $baseFilename;
        $targetPath = $directory ? "{$directory}/{$filename}" : $filename;
        $counter = 1;

        while ($disk->exists($targetPath)) {
            $filename = "{$nameOnly}-{$counter}.{$extension}";
            $targetPath = $directory ? "{$directory}/{$filename}" : $filename;
            $counter++;
        }

        if ($isImage) {
            $webpTempPath = static::convertToWebp($file->getRealPath(), 85);
            if ($webpTempPath && file_exists($webpTempPath)) {
                $stream = fopen($webpTempPath, 'r');
                $disk->put($targetPath, $stream, $component->getVisibility() ?? 'public');
                if (is_resource($stream)) {
                    fclose($stream);
                }
                @unlink($webpTempPath);

                return $targetPath;
            }
        }

        // Fallback for non-images (e.g. PDFs) or if GD conversion fails
        $stream = fopen($file->getRealPath(), 'r');
        $disk->put($targetPath, $stream, $component->getVisibility() ?? 'public');
        if (is_resource($stream)) {
            fclose($stream);
        }

        return $targetPath;
    }
}
