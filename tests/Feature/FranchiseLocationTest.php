<?php

namespace Tests\Feature;

use App\Filament\Resources\Locations\Pages\CreateLocation;
use App\Filament\Resources\Locations\Pages\EditLocation;
use App\Models\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FranchiseLocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_view_franchise_centers_in_admin_panel(): void
    {
        $user = User::factory()->create();

        $location = Location::create([
            'name' => 'Chennai - Velachery Center',
            'slug' => 'chennai-velachery-center',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'address' => 'Plot 15, 100 Feet Bypass Road, Velachery',
            'pincode' => '600042',
            'phone' => '+91 98765 11111',
            'email' => 'velachery@srideekshaa.com',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($user)->get('/admin/franchises');

        $response->assertStatus(200);
        $response->assertSee('Chennai - Velachery Center');
        $response->assertSee('Chennai');
    }

    public function test_authenticated_admin_can_create_a_new_franchise_center_from_admin(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CreateLocation::class)
            ->fillForm([
                'name' => 'Salem - Fairlands Center',
                'slug' => 'salem-fairlands-center',
                'city' => 'Salem',
                'state' => 'Tamil Nadu',
                'address' => '45, Brindavan Road, Fairlands',
                'pincode' => '636016',
                'phone' => '+91 98765 22222',
                'email' => 'salem@srideekshaa.com',
                'description' => 'Flagship academy center in Salem offering abacus, robotics, and Vedic maths.',
                'is_active' => true,
                'sort_order' => 10,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('locations', [
            'name' => 'Salem - Fairlands Center',
            'slug' => 'salem-fairlands-center',
            'city' => 'Salem',
            'pincode' => '636016',
        ]);
    }

    public function test_authenticated_admin_can_edit_existing_franchise_center(): void
    {
        $user = User::factory()->create();

        $location = Location::create([
            'name' => 'Madurai - KK Nagar Center',
            'slug' => 'madurai-kk-nagar-center',
            'city' => 'Madurai',
            'state' => 'Tamil Nadu',
            'address' => '12, 80 Feet Road, KK Nagar',
            'pincode' => '625020',
            'phone' => '+91 98765 33333',
            'email' => 'madurai@srideekshaa.com',
            'is_active' => true,
        ]);

        Livewire::actingAs($user)
            ->test(EditLocation::class, [
                'record' => $location->id,
            ])
            ->fillForm([
                'phone' => '+91 98765 99999',
                'description' => 'Updated modern learning center.',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'phone' => '+91 98765 99999',
            'description' => 'Updated modern learning center.',
        ]);
    }

    public function test_public_franchise_page_displays_active_franchise_centers(): void
    {
        Location::create([
            'name' => 'Trichy - Thillai Nagar Center',
            'slug' => 'trichy-thillai-nagar-center',
            'city' => 'Tiruchirappalli',
            'state' => 'Tamil Nadu',
            'address' => '10th Cross, Thillai Nagar',
            'pincode' => '620018',
            'phone' => '+91 98765 44444',
            'email' => 'trichy@srideekshaa.com',
            'is_active' => true,
        ]);

        $response = $this->get(route('pages.franchise'));

        $response->assertStatus(200);
        $response->assertSee('Trichy - Thillai Nagar Center');
        $response->assertSee('Tiruchirappalli');
        $response->assertSee('10th Cross, Thillai Nagar');
    }
}
