<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Sri Deekshaa International Academy
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Courses & Programs (SEO-friendly Hierarchy)
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/category/{slug}', [CourseController::class, 'category'])->name('courses.category');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');

// Enquiries / Lead capture
Route::post('/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store');

// Specialized Track Pages (SEO Landing Pages)
Route::get('/programs-for-kids', [PageController::class, 'forKids'])->name('pages.for-kids');
Route::get('/programs-for-teens', [PageController::class, 'forTeens'])->name('pages.for-teens');

// Interactive Skill Assessment Quiz
Route::get('/skill-assessment', [PageController::class, 'assessment'])->name('pages.assessment');

// Academy Events & Championships
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

// Institutional Pages
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/franchise', [PageController::class, 'franchise'])->name('pages.franchise');
Route::get('/franchise/verify/{code}', [PageController::class, 'franchiseVerify'])->name('pages.franchise.verify')->where('code', '.*');
Route::get('/franchise/{code}', [PageController::class, 'franchiseVerify'])->name('pages.franchise.show')->where('code', '[A-Za-z0-9\-_]+');

// Public Certificate Verification (Clean & SEO URLs)
Route::get('/verify-certificate', [PageController::class, 'verifyCertificate'])->name('pages.verify-certificate');
Route::get('/verify-certificate/results/{certificate_number}', [PageController::class, 'verifyCertificateResult'])->name('pages.verify-certificate.result');
Route::get('/verify-certificate/print/{certificate_number}', [PageController::class, 'printCertificate'])->name('pages.verify-certificate.print');
Route::get('/verify-certificate/{certificate_number}', [PageController::class, 'verifyCertificateResult'])->name('pages.verify-certificate.direct')->where('certificate_number', '[A-Za-z0-9\-_]+');

// Blog & Learning Articles (SEO-friendly Hierarchy)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Dynamic XML Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
