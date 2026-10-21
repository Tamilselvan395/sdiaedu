<?php

namespace App\Filament\Widgets;

use App\Enums\EnquiryStatus;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalEnquiries = Enquiry::count();
        $newLeads = Enquiry::where('status', EnquiryStatus::New->value)->count();
        $activeCourses = Course::where('is_active', true)->count();
        $totalStudents = Student::count();

        $stats = [
            Stat::make('Total Enquiries', $totalEnquiries)
                ->description('All time leads received')
                ->color('primary'),

            Stat::make('New Leads', $newLeads)
                ->description('Awaiting first contact')
                ->color('warning'),
        ];

        if (auth()->user()?->hasFullAccess()) {
            $stats[] = Stat::make('Active Courses', $activeCourses)
                ->description('Currently offered courses')
                ->color('success');

            $stats[] = Stat::make('Students Enrolled', $totalStudents)
                ->description('Across all batches')
                ->color('info');
        }

        return $stats;
    }
}
