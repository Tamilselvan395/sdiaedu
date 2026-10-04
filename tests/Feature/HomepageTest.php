<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The homepage must render successfully.
     */
    public function test_homepage_returns_200(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Why Parents &amp; Learners Choose Sri Deekshaa', false);
        $response->assertSee('why-choose-swiper');
        $response->assertSee('Transforming Potential into Tangible Confidence');
        $response->assertSee('testimonials-swiper');
        $response->assertSee('swiper-bundle.min.js');
    }
}
