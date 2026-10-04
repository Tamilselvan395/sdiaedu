<?php

namespace App\Services\Tracking;

use App\Enums\EnquiryStatus;
use App\Models\Enquiry;
use Illuminate\Support\Collection;

class GoogleAdsOfflineConversionService
{
    /**
     * Generate standard Google Ads Offline Conversion CSV data for converted enquiries with gclid.
     *
     * @param  Collection<int, Enquiry>|null  $enquiries
     * @return string CSV content
     */
    public static function generateCsv(?Collection $enquiries = null): string
    {
        return static::generateGoogleAdsCsv($enquiries);
    }

    public static function generateGoogleAdsCsv(?Collection $enquiries = null): string
    {
        $enquiries = $enquiries ?: Enquiry::whereNotNull('gclid')
            ->whereIn('status', ['converted', 'enrolled', 'qualified', 'Admitted', 'Trial Completed'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $rows = [];
        // Google Ads standard upload headers
        $rows[] = ['Google Click ID', 'Conversion Name', 'Conversion Time', 'Conversion Value', 'Conversion Currency'];

        foreach ($enquiries as $enquiry) {
            $conversionTime = $enquiry->updated_at ? $enquiry->updated_at->timezone('Asia/Kolkata')->format('Y-m-d H:i:sP') : now()->timezone('Asia/Kolkata')->format('Y-m-d H:i:sP');
            $statusVal = $enquiry->status instanceof EnquiryStatus ? $enquiry->status->value : (string) $enquiry->status;
            $conversionName = in_array($statusVal, ['enrolled', 'Admitted']) ? 'Student Enrollment' : 'Qualified Lead';
            $value = $enquiry->course?->fee ?? 5000.00;

            $rows[] = [
                $enquiry->gclid,
                $conversionName,
                $conversionTime,
                number_format($value, 2, '.', ''),
                'INR',
            ];
        }

        $fp = fopen('php://memory', 'r+');
        foreach ($rows as $row) {
            fputcsv($fp, $row);
        }
        rewind($fp);
        $csv = stream_get_contents($fp);
        fclose($fp);

        return $csv;
    }
}
