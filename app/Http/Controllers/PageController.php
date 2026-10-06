<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Faq;
use App\Models\Location;
use App\Models\SkillAssessment;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $teachers = Teacher::where('status', 'Active')->take(6)->get();

        return view('pages.about', compact('teachers'));
    }

    public function contact(): View
    {
        $locations = Location::where('is_active', true)->get();
        $faqs = Faq::where('is_active', true)->where('is_featured', true)->take(4)->get();

        return view('pages.contact', compact('locations', 'faqs'));
    }

    public function franchise(Request $request): mixed
    {
        $rawQuery = trim((string) $request->query('franchise_id', $request->query('code', '')));

        if ($rawQuery !== '') {
            $cleanCode = str_replace(['/', ' '], ['-', ''], $rawQuery);

            return redirect()->route('pages.franchise.verify', ['code' => $cleanCode]);
        }

        $searched = false;
        $selectedFranchise = null;
        $queryCode = '';

        return view('pages.franchise', compact('selectedFranchise', 'searched', 'queryCode'));
    }

    public function franchiseVerify(string $code): View
    {
        $queryCode = trim(urldecode($code));
        $searched = true;

        $slashCode = preg_replace('/-([0-9]{4})$/', '/$1', $queryCode);
        $hyphenCode = str_replace('/', '-', $queryCode);

        $selectedFranchise = Location::where('is_active', true)
            ->where(function ($q) use ($queryCode, $slashCode, $hyphenCode) {
                $q->where('franchise_id', $queryCode)
                    ->orWhere('franchise_id', strtoupper($queryCode))
                    ->orWhere('franchise_id', $slashCode)
                    ->orWhere('franchise_id', strtoupper($slashCode))
                    ->orWhere('franchise_id', $hyphenCode)
                    ->orWhere('slug', strtolower($queryCode))
                    ->orWhere('name', 'like', "%{$queryCode}%");
            })
            ->first();

        return view('pages.franchise', compact('selectedFranchise', 'searched', 'queryCode'));
    }

    public function forKids(): View
    {
        $kidsCourses = Course::where('is_active', true)
            ->where(function ($q) {
                $q->where('age_min', '<=', 10)
                    ->orWhere('age_max', '<=', 12);
            })
            ->with('category')
            ->orderBy('sort_order')
            ->get();

        return view('pages.for-kids', compact('kidsCourses'));
    }

    public function forTeens(): View
    {
        $teensCourses = Course::where('is_active', true)
            ->where(function ($q) {
                $q->where('age_min', '>=', 10)
                    ->orWhere('age_max', '>=', 14);
            })
            ->with('category')
            ->orderBy('sort_order')
            ->get();

        return view('pages.for-teens', compact('teensCourses'));
    }

    public function assessment(): View
    {
        $categories = CourseCategory::where('is_active', true)
            ->with(['activeCourses' => fn ($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        $assessment = SkillAssessment::where('is_active', true)
            ->with(['questions' => fn ($q) => $q->orderBy('sort_order')])
            ->first();

        return view('pages.assessment', compact('assessment', 'categories'));
    }

    public function verifyCertificate(Request $request)
    {
        $queryNumber = $request->query('certificate_number');

        if ($request->filled('certificate_number')) {
            return redirect()->route('pages.verify-certificate.result', ['certificate_number' => trim($queryNumber)]);
        }

        $certificate = null;
        $searched = false;
        $staticCourses = Certificate::getStaticCourses();

        return view('pages.verify-certificate', compact('certificate', 'searched', 'queryNumber', 'staticCourses'));
    }

    public function verifyCertificateResult(string $certificate_number): View
    {
        $queryNumber = trim($certificate_number);
        $certificate = Certificate::where('certificate_number', $queryNumber)
            ->with('student')
            ->first();

        $searched = true;
        $staticCourses = Certificate::getStaticCourses();

        return view('pages.verify-certificate', compact('certificate', 'searched', 'queryNumber', 'staticCourses'));
    }

    public function printCertificate(string $certificate_number): View
    {
        $queryNumber = trim($certificate_number);
        $certificate = Certificate::where('certificate_number', $queryNumber)
            ->with('student')
            ->firstOrFail();

        $staticCourses = Certificate::getStaticCourses();

        return view('pages.verify-certificate-print', compact('certificate', 'queryNumber', 'staticCourses'));
    }
}
