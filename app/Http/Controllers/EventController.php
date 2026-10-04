<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of upcoming and past academy events.
     */
    public function index(Request $request): View
    {
        $upcomingEvents = Event::upcoming()->get();
        $pastEvents = Event::past()->take(6)->get();

        return view('events.index', [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
            'metaTitle' => 'Upcoming Academy Events & Workshops | Sri Deekshaa International Academy',
            'metaDescription' => 'Explore upcoming student championships, robotics hackathons, teacher training seminars, and skill competitions at Sri Deekshaa International Academy.',
        ]);
    }

    /**
     * Display the specified event.
     */
    public function show(string $slug): View
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $otherEvents = Event::upcoming()
            ->where('id', '!=', $event->id)
            ->take(3)
            ->get();

        return view('events.show', [
            'event' => $event,
            'otherEvents' => $otherEvents,
            'metaTitle' => ($event->meta_title ?: $event->title).' | Sri Deekshaa International Academy',
            'metaDescription' => $event->meta_description ?: ($event->short_description ?: 'Join us for '.$event->title.' at Sri Deekshaa International Academy.'),
            'canonicalUrl' => route('events.show', $event->slug),
        ]);
    }
}
