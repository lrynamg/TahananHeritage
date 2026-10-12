<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VolunteerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected User $volunteerUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test users
        $this->adminUser = User::factory()->create(['role' => 'admin']);
        $this->volunteerUser = User::factory()->create(['role' => 'volunteer']);
    }

    /**
     * Test index returns 200 response
     */
    public function test_index_returns_200_response(): void
    {
        Volunteer::factory(20)->create();

        $response = $this
            ->actingAs($this->adminUser)
            ->get('/admin/volunteers');

        $response->assertStatus(200);
    }

    /**
     * Test show returns 200 response
     */
    public function test_show_returns_200_response(): void
    {
        $volunteer = Volunteer::factory()->create();

        $response = $this
            ->actingAs($this->adminUser)
            ->get("/admin/volunteers/{$volunteer->id}");

        $response->assertStatus(200);
    }

    /**
     * Test create returns 200 response
     */
    public function test_create_returns_200_response(): void
    {
        $response = $this
            ->actingAs($this->adminUser)
            ->get('/admin/volunteers/create');

        $response->assertStatus(200);
    }

    /**
     * Test store creates volunteer with valid data
     */
    public function test_store_creates_volunteer_with_valid_data(): void
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone_number' => '09123456789',
        ];

        $response = $this
            ->actingAs($this->adminUser)
            ->post('/admin/volunteers', $data);

        $this->assertDatabaseHas('volunteers', $data);
    }

    /**
     * Test store validates required fields
     */
    public function test_store_validates_required_fields(): void
    {
        $response = $this
            ->actingAs($this->adminUser)
            ->post('/admin/volunteers', [
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'phone_number' => '',
            ]);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'phone_number']);
    }

    /**
     * Test store validates unique email
     */
    public function test_store_validates_unique_email(): void
    {
        $volunteer = Volunteer::factory()->create();

        $response = $this
            ->actingAs($this->adminUser)
            ->post('/admin/volunteers', [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => $volunteer->email,
                'phone_number' => '09123456789',
            ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test store validates email format
     */
    public function test_store_validates_email_format(): void
    {
        $response = $this
            ->actingAs($this->adminUser)
            ->post('/admin/volunteers', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'invalid-email',
                'phone_number' => '09123456789',
            ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test store validates phone number format
     */
    public function test_store_validates_phone_number_format(): void
    {
        $response = $this
            ->actingAs($this->adminUser)
            ->post('/admin/volunteers', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone_number' => 'invalid-phone',
            ]);

        $response->assertSessionHasErrors('phone_number');
    }

    /**
     * Test edit returns 200 response
     */
    public function test_edit_returns_200_response(): void
    {
        $volunteer = Volunteer::factory()->create();

        $response = $this
            ->actingAs($this->adminUser)
            ->get("/admin/volunteers/{$volunteer->id}/edit");

        $response->assertStatus(200);
    }

    /**
     * Test update modifies volunteer with valid data
     */
    public function test_update_modifies_volunteer(): void
    {
        $volunteer = Volunteer::factory()->create();

        $updatedData = [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'phone_number' => '09987654321',
        ];

        $response = $this
            ->actingAs($this->adminUser)
            ->put("/admin/volunteers/{$volunteer->id}", $updatedData);

        $this->assertDatabaseHas('volunteers', $updatedData);
    }

    /**
     * Test update allows same email on same volunteer
     */
    public function test_update_allows_same_email(): void
    {
        $volunteer = Volunteer::factory()->create();

        $response = $this
            ->actingAs($this->adminUser)
            ->put("/admin/volunteers/{$volunteer->id}", [
                'first_name' => 'Updated',
                'last_name' => 'Name',
                'email' => $volunteer->email,
                'phone_number' => '09123456789',
            ]);

        $this->assertDatabaseHas('volunteers', [
            'id' => $volunteer->id,
            'first_name' => 'Updated',
            'email' => $volunteer->email,
        ]);
    }

    /**
     * Test update rejects duplicate email from another volunteer
     */
    public function test_update_rejects_duplicate_email(): void
    {
        $volunteer1 = Volunteer::factory()->create();
        $volunteer2 = Volunteer::factory()->create();

        $response = $this
            ->actingAs($this->adminUser)
            ->put("/admin/volunteers/{$volunteer1->id}", [
                'first_name' => 'Updated',
                'last_name' => 'Name',
                'email' => $volunteer2->email,
                'phone_number' => '09123456789',
            ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test destroy soft-deletes volunteer
     */
    public function test_destroy_soft_deletes_volunteer(): void
    {
        $volunteer = Volunteer::factory()->create();

        $response = $this
            ->actingAs($this->adminUser)
            ->delete("/admin/volunteers/{$volunteer->id}");

        $response->assertRedirect('/admin/volunteers');
        $response->assertSessionHas('success');

        // Verify soft delete
        $this->assertNull(Volunteer::find($volunteer->id));
        $this->assertNotNull(Volunteer::onlyTrashed()->find($volunteer->id));
    }

    /**
     * Test restore restores soft-deleted volunteer
     */
    public function test_restore_restores_soft_deleted_volunteer(): void
    {
        $volunteer = Volunteer::factory()->create();
        $volunteer->delete();

        $response = $this
            ->actingAs($this->adminUser)
            ->post("/admin/volunteers/{$volunteer->id}/restore");

        $response->assertRedirect('/admin/volunteers');
        $response->assertSessionHas('success');

        // Verify restore
        $this->assertNotNull(Volunteer::find($volunteer->id));
    }

    /**
     * Test forceDelete permanently deletes volunteer
     */
    public function test_force_delete_permanently_deletes_volunteer(): void
    {
        $volunteer = Volunteer::factory()->create();
        $volunteer->delete();
        $volunteerId = $volunteer->id;

        $response = $this
            ->actingAs($this->adminUser)
            ->delete("/admin/volunteers/{$volunteerId}/force");

        $response->assertRedirect('/admin/volunteers');
        $response->assertSessionHas('success');

        // Verify permanent deletion
        $this->assertNull(Volunteer::withTrashed()->find($volunteerId));
    }

    /**
     * Test showDeleted returns 200 response
     */
    public function test_show_deleted_returns_200_response(): void
    {
        $deletedVolunteer = Volunteer::factory()->create();
        $deletedVolunteer->delete();

        $response = $this
            ->actingAs($this->adminUser)
            ->get('/admin/volunteers/deleted');

        $response->assertStatus(200);
    }

    /**
     * Test volunteer user cannot access admin routes
     */
    public function test_volunteer_cannot_access_admin_routes(): void
    {
        $response = $this
            ->actingAs($this->volunteerUser)
            ->get('/admin/volunteers');

        $response->assertStatus(403);
    }

    /**
     * Test unauthenticated user is redirected to login
     */
    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get('/admin/volunteers');

        $response->assertRedirect('/login');
    }
}
