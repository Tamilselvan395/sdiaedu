<?php

namespace Tests\Feature;

use App\Models\CourseCategory;
use App\Models\User;
use App\Services\ImageUploadService;
use Filament\Forms\Components\FileUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploadServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_filename_is_lowercased_and_spaces_replaced_with_hyphens(): void
    {
        $filename1 = ImageUploadService::sanitizeFilename('My Super Cool Photo.png');
        $this->assertEquals('my-super-cool-photo.webp', $filename1);

        $filename2 = ImageUploadService::sanitizeFilename('BRAIN & ACADEMIC EXCELLENCE.JPG');
        $this->assertEquals('brain-academic-excellence.webp', $filename2);

        $filename3 = ImageUploadService::sanitizeFilename('vedic_maths class.png');
        $this->assertEquals('vedic-maths-class.webp', $filename3);
    }

    public function test_image_is_converted_to_webp_format(): void
    {
        Storage::fake('public');

        // Create a dummy PNG image
        $file = UploadedFile::fake()->image('Banner Photo.png', 400, 300);

        $component = new FileUpload('test');
        $component->disk('public');
        $component->directory('test-uploads');

        $storedPath = ImageUploadService::saveUploadedFileAsWebp($component, $file);

        $this->assertNotNull($storedPath);
        $this->assertEquals('test-uploads/banner-photo.webp', $storedPath);
        Storage::disk('public')->assertExists($storedPath);

        // Verify the stored file starts with RIFF and WEBP header
        $content = Storage::disk('public')->get($storedPath);
        $this->assertStringStartsWith('RIFF', $content);
        $this->assertStringContainsString('WEBP', substr($content, 0, 16));
    }

    public function test_uploaded_file_preview_returns_proper_structure_and_relative_url(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('categories/sample-test.webp', 'dummy-webp-binary-data');

        $component = new FileUpload('hero_image');
        $component->disk('public');

        $fileData = ImageUploadService::getUploadedFileData($component, 'categories/sample-test.webp');

        $this->assertIsArray($fileData);
        $this->assertEquals('sample-test.webp', $fileData['name']);
        $this->assertGreaterThan(0, $fileData['size']);
        $this->assertEquals('/storage/categories/sample-test.webp', $fileData['url']);
    }

    public function test_uploaded_file_returns_null_when_not_existing(): void
    {
        Storage::fake('public');

        $component = new FileUpload('hero_image');
        $component->disk('public');

        $fileData = ImageUploadService::getUploadedFileData($component, 'categories/non-existing.webp');

        $this->assertNull($fileData);
    }

    public function test_course_category_edit_page_renders_with_uploaded_image(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('categories/arts-creativity-studio.webp', 'dummy-data');

        $user = User::factory()->create();
        $category = CourseCategory::factory()->create([
            'hero_image' => 'categories/arts-creativity-studio.webp',
        ]);

        $response = $this->actingAs($user)->get("/admin/course-categories/{$category->slug}/edit");
        $response->assertStatus(200);
        $response->assertSee('arts-creativity-studio.webp');
    }
}
