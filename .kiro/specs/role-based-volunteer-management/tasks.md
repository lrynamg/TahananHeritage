# Implementation Tasks: Role-Based Volunteer Management & Refactoring

## Overview

This task list breaks down the feature design into discrete, actionable implementation steps. Each task builds on previous work, validates core functionality early through tests, and ensures all requirements are covered. Tasks are grouped by component (migrations, models, middleware, etc.) and marked as Required (core) or Optional (enhancements).

---

## Phase 1: Database Foundation

### Database Migrations

- [x] 1.1 Add soft-delete columns and role column to User model
  - Create migration: `add_role_and_soft_deletes_to_users_table`
  - Add `role` enum column (admin/volunteer) with default 'volunteer'
  - Add nullable `deleted_at` timestamp for soft-delete support
  - Run migration to verify schema changes
  - _Requirements: 2.1, 11.1, 11.4_

- [x] 1.2 Add soft-delete support to Volunteer table migration
  - Update or create migration for Volunteer table
  - Add nullable `deleted_at` timestamp column
  - Ensure `first_name`, `last_name`, `email`, `phone_number` exist
  - Run migration successfully
  - _Requirements: 2.1, 2.2, 11.1, 11.2_

- [x] 1.3 Add soft-delete support to Founder table migration
  - Update or create migration for Founder table
  - Add nullable `deleted_at` timestamp column
  - Ensure `first_name`, `last_name`, `position`, `img_url` exist
  - Run migration successfully
  - _Requirements: 2.1, 2.3, 11.1, 11.3_

- [x] 1.4 Add soft-delete support to Home table migration
  - Update or create migration for Home table
  - Add nullable `deleted_at` timestamp column
  - Ensure `house_name`, `location`, `img_url` exist
  - Run migration successfully
  - _Requirements: 2.1, 2.4, 11.1, 11.5_

### Factories

- [x] 1.5 Create VolunteerFactory with realistic Faker methods
  - Create `database/factories/VolunteerFactory.php`
  - Implement `definition()` method with:
    - `first_name` using `faker->firstName()`
    - `last_name` using `faker->lastName()`
    - `email` using `faker->unique()->safeEmail()`
    - `phone_number` using `faker->phoneNumber()`
  - Test factory generates valid records
  - _Requirements: 3.5, 12.2_

- [x] 1.6 Create FounderFactory with image URL support
  - Create `database/factories/FounderFactory.php`
  - Implement `definition()` method with:
    - `first_name`, `last_name` using Faker methods
    - `position` using `faker->jobTitle()`
    - `img_url` using `faker->imageUrl()` (optional)
  - Test factory generates valid records
  - _Requirements: 12.3_

- [x] 1.7 Create HomeFactory with Philippine locations
  - Create `database/factories/HomeFactory.php`
  - Implement `definition()` method with:
    - `house_name` using `faker->catchPhrase()`
    - `location` from predefined Philippine locations
    - `img_url` using `faker->imageUrl()` (optional)
  - Test factory generates valid records
  - _Requirements: 12.4_

---

## Phase 2: Model Updates & Relationships

### User Model Updates

- [x] 2.1 Update User model with SoftDeletes, role property, and helper methods
  - Add `SoftDeletes` trait to User model
  - Add `role` to fillable array with values 'admin' or 'volunteer'
  - Implement `isAdmin()` helper method returning `$this->role === 'admin'`
  - Implement `isVolunteer()` helper method returning `$this->role === 'volunteer'`
  - Add role scopes: `scopeAdmins()` and `scopeVolunteers()`
  - Cast `role` as string in `$casts`
  - Add relationship: `hasOne(Volunteer)` named `volunteer()`
  - _Requirements: 1.2, 2.1, 2.7_

### Volunteer Model

- [x] 2.2 Create/update Volunteer model with SoftDeletes and relationships
  - Ensure Volunteer model exists at `app/Models/Volunteer.php`
  - Add `SoftDeletes` trait
  - Set `fillable` array: `['first_name', 'last_name', 'email', 'phone_number']`
  - Add relationship: `belongsTo(User)` named `user()` (optional foreign key)
  - Implement `getFullNameAttribute()` accessor returning combined first/last name
  - Cast `deleted_at` to datetime
  - Test model instantiation and attribute access
  - _Requirements: 2.1, 2.2, 2.6_

### Founder Model

- [x] 2.3 Create/update Founder model with SoftDeletes
  - Ensure Founder model exists at `app/Models/Founder.php`
  - Add `SoftDeletes` trait
  - Set `fillable` array: `['first_name', 'last_name', 'position', 'img_url']`
  - Implement `getFullNameAttribute()` accessor
  - Cast `deleted_at` to datetime
  - Test model instantiation and attributes
  - _Requirements: 2.1, 2.3, 2.6_

### Home Model

- [x] 2.4 Create/update Home model with SoftDeletes
  - Ensure Home model exists at `app/Models/Home.php`
  - Add `SoftDeletes` trait
  - Set `fillable` array: `['house_name', 'location', 'img_url']`
  - Cast `deleted_at` to datetime
  - Test model instantiation and attributes
  - _Requirements: 2.1, 2.4, 2.6_

---

## Phase 3: Middleware & Authorization

- [x] 3.1 Create CheckRole middleware for request-level role attachment
  - Create `app/Http/Middleware/CheckRole.php`
  - Implement `handle()` method:
    - Check if user is authenticated
    - Redirect to login if not authenticated
    - Attach `$request->userRole = $user->role` for convenience
    - Call next middleware
  - Register middleware in `bootstrap/app.php` or `app/Http/Kernel.php`
  - Test middleware allows authenticated users through
  - _Requirements: 1.3, 1.7_

- [x] 3.2 Create IsAdmin middleware for admin-only route protection
  - Create `app/Http/Middleware/IsAdmin.php`
  - Implement `handle()` method:
    - Check if user is authenticated AND is admin
    - Redirect non-admins to volunteer dashboard with error flash message
    - Allow admins to proceed
  - Register middleware in `bootstrap/app.php` or `app/Http/Kernel.php`
  - Test middleware allows admins and redirects volunteers
  - _Requirements: 1.3, 1.4, 1.7_

---

## Phase 4: Form Requests & Validation

- [x] 4.1 Create StoreVolunteerRequest with validation rules
  - Create `app/Http/Requests/StoreVolunteerRequest.php`
  - Implement `authorize()`: return `auth()->user()->isAdmin()`
  - Implement `rules()`:
    - `first_name`: required, string, max 100
    - `last_name`: required, string, max 100
    - `email`: required, email, unique on volunteers table, max 255
    - `phone_number`: required, regex for phone format, max 20
  - Implement `messages()` with custom error messages
  - Test validation passes with valid data
  - Test validation fails with invalid email (not unique)
  - _Requirements: 1.1, 8.2, 8.5_

- [x] 4.2 Create UpdateVolunteerRequest with ID exclusion for unique email
  - Create `app/Http/Requests/UpdateVolunteerRequest.php`
  - Implement `authorize()`: return `auth()->user()->isAdmin()`
  - Implement `rules()` with unique email check excluding current volunteer ID
  - Use `$this->volunteer->id` to skip current record in unique validation
  - Test validation allows existing email on same record
  - Test validation rejects duplicate email from another volunteer
  - _Requirements: 1.1, 8.2, 8.5_

- [x] 4.3 Create UpdateVolunteerProfileRequest for volunteer self-profile updates
  - Create `app/Http/Requests/UpdateVolunteerProfileRequest.php`
  - Implement `authorize()`: return `auth()->check() && auth()->user()->isVolunteer()`
  - Implement `rules()` matching UpdateVolunteerRequest
  - Get `$volunteerId = auth()->user()->volunteer->id` for unique email exclusion
  - Test authorization blocks non-volunteers
  - _Requirements: 1.5, 6.4, 8.4_

- [x] 4.4 Create StoreFounderRequest with validation rules
  - Create `app/Http/Requests/StoreFounderRequest.php`
  - Implement `authorize()`: return `auth()->user()->isAdmin()`
  - Implement `rules()`:
    - `first_name`: required, string, max 100
    - `last_name`: required, string, max 100
    - `position`: required, string, max 150
    - `img_url`: nullable, url format
  - Implement custom error messages
  - Test validation with valid founder data
  - _Requirements: 8.3, 8.5_

- [x] 4.5 Create UpdateFounderRequest with authorization and unique checks
  - Create `app/Http/Requests/UpdateFounderRequest.php`
  - Implement `authorize()`: return `auth()->user()->isAdmin()`
  - Implement `rules()` matching StoreFounderRequest
  - Test validation behavior
  - _Requirements: 8.3, 8.5_

- [x] 4.6 Create StoreHomeRequest with validation rules
  - Create `app/Http/Requests/StoreHomeRequest.php`
  - Implement `authorize()`: return `auth()->user()->isAdmin()`
  - Implement `rules()`:
    - `house_name`: required, string, max 200
    - `location`: required, string, max 200
    - `img_url`: nullable, url format
  - Implement custom error messages
  - _Requirements: 8.4, 8.5_

- [x] 4.7 Create UpdateHomeRequest with authorization and unique checks
  - Create `app/Http/Requests/UpdateHomeRequest.php`
  - Implement `authorize()`: return `auth()->user()->isAdmin()`
  - Implement `rules()` matching StoreHomeRequest
  - _Requirements: 8.4, 8.5_

---

## Phase 5: Admin Controllers

- [x] 5.1 Create admin VolunteerController with CRUD and soft-delete operations
  - Create `app/Http/Controllers/Admin/VolunteerController.php`
  - Implement methods:
    - `index()`: Display paginated list of active volunteers (15 per page)
    - `show()`: Display specific volunteer details
    - `create()`: Display volunteer creation form
    - `store()`: Validate with StoreVolunteerRequest, create volunteer, redirect with success
    - `edit()`: Display edit form with pre-populated data
    - `update()`: Validate with UpdateVolunteerRequest, update volunteer, redirect with success
    - `destroy()`: Soft-delete volunteer, redirect with success
    - `restore()`: Restore soft-deleted volunteer by ID, redirect with success
    - `forceDelete()`: Permanently delete soft-deleted volunteer with confirmation message, redirect
    - `showDeleted()`: List soft-deleted volunteers with pagination
  - Test controller methods return correct views
  - Test controller methods perform database operations
  - _Requirements: 1.6, 4.1, 5.1, 9.1_

- [x] 5.2 Create admin FounderController with CRUD and soft-delete operations
  - Create `app/Http/Controllers/Admin/FounderController.php`
  - Implement same method structure as VolunteerController
  - Methods: `index()`, `show()`, `create()`, `store()`, `edit()`, `update()`, `destroy()`, `restore()`, `forceDelete()`, `showDeleted()`
  - Test controller functionality
  - _Requirements: 1.6, 4.2, 5.2, 9.1_

- [x] 5.3 Create admin HomeController with CRUD and soft-delete operations
  - Create `app/Http/Controllers/Admin/HomeController.php`
  - Implement same method structure as VolunteerController
  - Methods: `index()`, `show()`, `create()`, `store()`, `edit()`, `update()`, `destroy()`, `restore()`, `forceDelete()`, `showDeleted()`
  - Paginate with 15 records per page
  - Test controller functionality
  - _Requirements: 1.6, 4.3, 5.3, 9.1_

- [x] 5.4 Create admin DashboardController for main admin landing page
  - Create `app/Http/Controllers/Admin/DashboardController.php`
  - Implement `index()` method returning admin dashboard view
  - Display welcome/overview information
  - Test controller returns admin dashboard view
  - _Requirements: 5.1_

---

## Phase 6: Volunteer Controller

- [x] 6.1 Create volunteer VolunteerProfileController for profile self-management
  - Create `app/Http/Controllers/Volunteer/VolunteerProfileController.php`
  - Implement methods:
    - `show()`: Get `auth()->user()->volunteer`, display profile view
    - `edit()`: Get `auth()->user()->volunteer`, display edit form
    - `update()`: Validate with UpdateVolunteerProfileRequest, update volunteer, redirect with success
  - Test controller restricts access to authenticated volunteers
  - Test controller prevents volunteers from editing other profiles
  - _Requirements: 1.5, 6.3, 6.4, 6.5_

- [x] 6.2 Create volunteer VolunteerDashboardController for volunteer landing page
  - Create `app/Http/Controllers/Volunteer/VolunteerDashboardController.php`
  - Implement `index()` method returning volunteer dashboard view
  - Display welcome message and limited navigation
  - Test controller returns volunteer dashboard view
  - _Requirements: 6.1, 6.2_

---

## Phase 7: Routes

- [x] 7.1 Define admin routes with IsAdmin middleware protection
  - Update `routes/web.php` or create `routes/admin.php`
  - Create route group with middleware: `['auth', 'verified', 'is.admin']`
  - Add prefix 'admin' and name prefix 'admin.'
  - Define routes:
    - `GET /admin/dashboard` → DashboardController@index → 'dashboard'
    - Volunteer CRUD routes (index, create, store, show, edit, update, destroy)
    - Volunteer soft-delete routes (restore, forceDelete, showDeleted)
    - Founder CRUD routes (same pattern)
    - Founder soft-delete routes
    - Home CRUD routes (same pattern)
    - Home soft-delete routes
  - Test routes generate correct URLs with route() helper
  - _Requirements: 5.2, 5.3, 5.4_

- [x] 7.2 Define volunteer routes with auth middleware
  - Update `routes/web.php` or create `routes/volunteer.php`
  - Create route group with middleware: `['auth', 'verified']`
  - Add prefix 'volunteer' and name prefix 'volunteer.'
  - Define routes:
    - `GET /volunteer/dashboard` → VolunteerDashboardController@index → 'dashboard'
    - `GET /volunteer/profile` → VolunteerProfileController@show → 'profile.show'
    - `GET /volunteer/profile/edit` → VolunteerProfileController@edit → 'profile.edit'
    - `PUT /volunteer/profile` → VolunteerProfileController@update → 'profile.update'
  - Test routes are accessible only when authenticated
  - _Requirements: 6.2, 6.3_

---

## Phase 8: Seeders

- [x] 8.1 Create VolunteerSeeder calling factory to generate 100 records
  - Create or update `database/seeders/VolunteerSeeder.php`
  - Implement `run()` method: `Volunteer::factory(100)->create()`
  - Comment code explaining the seeder generates 100 realistic volunteers
  - _Requirements: 3.1_

- [x] 8.2 Create FounderSeeder calling factory to generate founder records
  - Create or update `database/seeders/FounderSeeder.php`
  - Implement `run()` method: `Founder::factory(10)->create()`
  - Comment explaining seeder purpose
  - _Requirements: 12.1_

- [x] 8.3 Create HomeSeeder calling factory to generate heritage home records
  - Create or update `database/seeders/HomeSeeder.php`
  - Implement `run()` method: `Home::factory(8)->create()`
  - Comment explaining seeder purpose
  - _Requirements: 12.1_

- [x] 8.4 Update DatabaseSeeder to call all seeders in correct order
  - Update `database/seeders/DatabaseSeeder.php`
  - Create test admin user:
    - Email: 'admin@example.com', Password: default, Role: 'admin'
  - Create test volunteer user:
    - Email: 'volunteer@example.com', Password: default, Role: 'volunteer'
  - Call seeders in order:
    - FounderSeeder
    - HomeSeeder
    - VolunteerSeeder
  - Run `php artisan db:seed` and verify no errors
  - Verify 100 volunteers are created
  - _Requirements: 3.1, 3.4, 12.1, 12.5_

---

## Phase 9: Admin Dashboard Views

- [x] 9.1 Create admin dashboard landing page view
  - Create `resources/views/admin/dashboard.blade.php`
  - Display main overview page with welcome message
  - Include admin layout with navigation menu
  - Display quick statistics (volunteer count, founder count, home count)
  - Navigation menu links to:
    - Manage Volunteers
    - Manage Founders
    - Manage Heritage Homes
  - Responsive design
  - _Requirements: 5.1, 5.2_

- [x] 9.2 Create admin volunteers index view with pagination and action buttons
  - Create `resources/views/admin/volunteers/index.blade.php`
  - Display paginated list ({{ $volunteers->links() }}) with 15 records
  - Create table with columns:
    - First Name, Last Name, Email, Phone Number, Actions
  - Action buttons:
    - View (route 'admin.volunteers.show')
    - Edit (route 'admin.volunteers.edit')
    - Soft-Delete (form to 'admin.volunteers.destroy')
    - Restore (if applicable, form to 'admin.volunteers.restore')
    - Permanently Delete (form to 'admin.volunteers.force-delete' with confirmation)
  - Include "Create Volunteer" button linking to 'admin.volunteers.create'
  - Include tab/filter for "Show Deleted Records"
  - Display "No records found" message when empty
  - _Requirements: 5.3, 9.1, 9.2, 9.3_

- [x] 9.3 Create admin volunteers create form view
  - Create `resources/views/admin/volunteers/create.blade.php`
  - Display form posting to 'admin.volunteers.store'
  - Form fields with labels:
    - First Name (required, text input)
    - Last Name (required, text input)
    - Email (required, email input)
    - Phone Number (required, tel input)
  - Display validation errors for each field
  - Include submit button labeled "Create Volunteer"
  - Include cancel button returning to previous page
  - Responsive design
  - _Requirements: 7.1, 8.1, 8.5, 8.6, 8.7_

- [x] 9.4 Create admin volunteers edit form view
  - Create `resources/views/admin/volunteers/edit.blade.php`
  - Display form posting to 'admin.volunteers.update' (PUT method)
  - Pre-populate all form fields with volunteer data
  - Same fields and validation error display as create form
  - Include submit button labeled "Update Volunteer"
  - Include cancel button
  - Responsive design
  - _Requirements: 7.2, 8.1, 8.5_

- [x] 9.5 Create admin volunteers show/detail view
  - Create `resources/views/admin/volunteers/show.blade.php`
  - Display volunteer full name and details (non-editable)
  - Show created_at and updated_at timestamps
  - Include action buttons:
    - Edit (link to 'admin.volunteers.edit')
    - Back to List (link to 'admin.volunteers.index')
  - _Requirements: 5.3, 9.1_

- [x] 9.6 Create admin volunteers deleted view
  - Create `resources/views/admin/volunteers/deleted.blade.php`
  - Display paginated list of soft-deleted volunteers (15 per page)
  - Table with columns: First Name, Last Name, Email, Deleted At, Actions
  - Action buttons:
    - Restore (form to 'admin.volunteers.restore')
    - Permanently Delete (form to 'admin.volunteers.force-delete' with confirmation)
  - Display "No deleted records" when empty
  - _Requirements: 4.3, 5.3, 9.1_

- [x] 9.7 Create admin founders management views (index, create, edit, show, deleted)
  - Create `resources/views/admin/founders/` directory with same structure as volunteers:
    - `index.blade.php` (list all founders with pagination, action buttons)
    - `create.blade.php` (form with first_name, last_name, position, img_url fields)
    - `edit.blade.php` (pre-populated edit form)
    - `show.blade.php` (detail view)
    - `deleted.blade.php` (list soft-deleted founders)
  - Match structure and styling of volunteer views
  - _Requirements: 5.4, 9.1, 9.2_

- [x] 9.8 Create admin heritage homes management views (index, create, edit, show, deleted)
  - Create `resources/views/admin/homes/` directory with same structure as volunteers:
    - `index.blade.php` (list all homes with pagination)
    - `create.blade.php` (form with house_name, location, img_url fields)
    - `edit.blade.php` (pre-populated edit form)
    - `show.blade.php` (detail view)
    - `deleted.blade.php` (list soft-deleted homes)
  - Match structure and styling of volunteer views
  - _Requirements: 5.5, 5.6, 9.1_

- [x] 9.9 Create admin layout template with navigation menu
  - Create `resources/views/admin/layouts/app.blade.php`
  - Include header with site branding and admin navigation
  - Sidebar or top navigation with links:
    - Dashboard (route 'admin.dashboard')
    - Manage Volunteers (route 'admin.volunteers.index')
    - Manage Founders (route 'admin.founders.index')
    - Manage Heritage Homes (route 'admin.homes.index')
    - Logout
  - Include main content area with @yield('content')
  - Display flash notifications for success/error messages
  - Responsive design
  - _Requirements: 5.1, 5.2_

---

## Phase 10: Volunteer Dashboard Views

- [x] 10.1 Create volunteer dashboard landing page view
  - Create `resources/views/volunteer/dashboard.blade.php`
  - Display welcome message with volunteer's name
  - Show limited navigation menu:
    - My Profile (route 'volunteer.profile.show')
    - Logout
  - Display helpful information or welcome message
  - Prevent access to admin pages (via middleware)
  - Responsive design
  - _Requirements: 6.1, 6.2_

- [x] 10.2 Create volunteer profile show view
  - Create `resources/views/volunteer/profile/show.blade.php`
  - Display volunteer's own profile information:
    - First Name, Last Name, Email, Phone Number
  - Display as read-only or lightly styled
  - Include "Edit Profile" button linking to 'volunteer.profile.edit'
  - Include "Back to Dashboard" button
  - _Requirements: 6.3, 6.5_

- [x] 10.3 Create volunteer profile edit view
  - Create `resources/views/volunteer/profile/edit.blade.php`
  - Display form posting to 'volunteer.profile.update' (PUT method)
  - Form fields (same as admin, but volunteer editing only their own):
    - First Name (required, text input)
    - Last Name (required, text input)
    - Email (required, email input)
    - Phone Number (required, tel input)
  - Display validation errors for each field
  - Include submit button labeled "Update Profile"
  - Include cancel button returning to profile show
  - _Requirements: 6.3, 6.4, 6.5, 8.2_

- [x] 10.4 Create volunteer layout template with restricted navigation
  - Create `resources/views/volunteer/layouts/app.blade.php`
  - Include header with site branding and volunteer navigation
  - Navigation menu with links:
    - Dashboard (route 'volunteer.dashboard')
    - My Profile (route 'volunteer.profile.show')
    - Logout
  - Include main content area with @yield('content')
  - Display flash notifications for success/error messages
  - Prevent inline linking to admin pages
  - Responsive design
  - _Requirements: 6.1, 6.2_

---

## Phase 11: Authentication Views (Optional - Design Only)

- [x]* 11.1 Update login page with heritage-inspired design
  - Update `resources/views/auth/login.blade.php`
  - Maintain existing authentication logic (no changes to controller behavior)
  - Update visual design:
    - Incorporate heritage-inspired color scheme (earth tones, Philippine colors)
    - Add site branding/logo at top
    - Use consistent typography and spacing with main website
    - Ensure responsive mobile/desktop layout
  - Test form still submits to correct endpoint
  - _Requirements: 10.1, 10.3_

- [x]* 11.2 Update register page with heritage-inspired design
  - Update `resources/views/auth/register.blade.php`
  - Maintain existing registration logic (no changes to controller)
  - Match visual design of login page
  - Incorporate heritage aesthetic
  - Ensure responsive layout
  - _Requirements: 10.2, 10.3_

---

## Phase 12: Testing & Verification

### Model & Database Tests

- [ ]* 12.1 Write feature test for User model SoftDeletes functionality
  - Test that soft-deleted users have `deleted_at` timestamp set
  - Test that `User::all()` excludes soft-deleted users by default
  - Test that `User::withTrashed()->count()` includes soft-deleted users
  - Test that user restoration works: `$user->restore()`
  - Test that permanent deletion works: `$user->forceDelete()`
  - _Requirements: 2.1, 4.1_

- [ ]* 12.2 Write feature test for Volunteer model relationships and soft-deletes
  - Test Volunteer model has SoftDeletes trait
  - Test soft-delete functionality (delete, restore, forceDelete)
  - Test full name accessor: `$volunteer->full_name`
  - Test Volunteer factory creates valid records
  - _Requirements: 2.1, 2.2, 3.5_

- [ ]* 12.3 Write feature test for Founder model SoftDeletes
  - Test soft-delete functionality
  - Test factory generates valid founder records
  - Test full name accessor
  - _Requirements: 2.1, 2.3_

- [ ]* 12.4 Write feature test for Home model SoftDeletes
  - Test soft-delete functionality
  - Test factory generates valid home records
  - _Requirements: 2.1, 2.4_

### Middleware Tests

- [ ]* 12.5 Write feature test for CheckRole middleware
  - Test that authenticated requests pass through middleware
  - Test that unauthenticated requests redirect to login
  - Test that `$request->userRole` is set correctly
  - _Requirements: 1.7, 3.1_

- [ ]* 12.6 Write feature test for IsAdmin middleware
  - Test that admins can access protected admin routes
  - Test that volunteers are redirected to volunteer dashboard
  - Test that error flash message is displayed to volunteers
  - Test that unauthenticated users redirect to login
  - _Requirements: 1.3, 1.4, 1.7_

### Controller Tests

- [ ]* 12.7 Write feature tests for admin VolunteerController
  - Test `index()` returns paginated list of volunteers
  - Test `create()` displays form
  - Test `store()` with valid data creates volunteer
  - Test `store()` with invalid data returns validation errors
  - Test `edit()` pre-populates form
  - Test `update()` modifies volunteer
  - Test `destroy()` soft-deletes volunteer
  - Test `restore()` restores soft-deleted volunteer
  - Test `forceDelete()` permanently deletes volunteer
  - Test `showDeleted()` displays soft-deleted volunteers
  - Test only admins can access these routes
  - _Requirements: 1.6, 5.1_

- [ ]* 12.8 Write feature tests for admin FounderController
  - Follow same pattern as VolunteerController tests
  - Test all CRUD and soft-delete operations
  - Test authorization (admin-only access)
  - _Requirements: 1.6, 5.2_

- [ ]* 12.9 Write feature tests for admin HomeController
  - Follow same pattern as VolunteerController tests
  - Test all CRUD and soft-delete operations
  - Test authorization (admin-only access)
  - _Requirements: 1.6, 5.3_

- [ ]* 12.10 Write feature test for VolunteerProfileController
  - Test `show()` displays volunteer's own profile
  - Test `edit()` displays edit form
  - Test `update()` with valid data updates profile
  - Test `update()` with invalid data returns validation errors
  - Test volunteer cannot access other volunteers' profiles
  - Test non-volunteers cannot access these routes
  - _Requirements: 1.5, 6.1, 6.3_

### Form Request Tests

- [ ]* 12.11 Write feature test for StoreVolunteerRequest validation
  - Test valid volunteer data passes validation
  - Test missing required fields fail validation
  - Test invalid email format fails validation
  - Test duplicate email fails validation (unique constraint)
  - Test invalid phone number format fails validation
  - Test authorization: only admins can create volunteers
  - _Requirements: 4.1, 8.2_

- [ ]* 12.12 Write feature test for UpdateVolunteerRequest validation
  - Test valid update data passes validation
  - Test allows same email on same volunteer record
  - Test rejects duplicate email from different volunteer
  - Test only admins can update volunteers
  - _Requirements: 4.2, 8.2_

- [ ]* 12.13 Write feature test for UpdateVolunteerProfileRequest validation
  - Test valid volunteer profile data passes validation
  - Test only volunteers can update their own profile
  - Test authorization prevents non-volunteers
  - _Requirements: 4.3, 8.2_

- [ ]* 12.14 Write feature tests for FounderRequest validation
  - Test StoreFounderRequest with valid/invalid data
  - Test UpdateFounderRequest with valid/invalid data
  - Test authorization (admin-only)
  - _Requirements: 4.4, 4.5, 8.3_

- [ ]* 12.15 Write feature tests for HomeRequest validation
  - Test StoreHomeRequest with valid/invalid data
  - Test UpdateHomeRequest with valid/invalid data
  - Test authorization (admin-only)
  - _Requirements: 4.6, 4.7, 8.4_

### Route Tests

- [ ]* 12.16 Write feature test for admin routes protection
  - Test all admin routes redirect volunteers to volunteer dashboard
  - Test all admin routes redirect unauthenticated users to login
  - Test admin routes are accessible to admins
  - _Requirements: 7.1_

- [ ]* 12.17 Write feature test for volunteer routes protection
  - Test volunteer routes redirect unauthenticated users to login
  - Test volunteer routes are accessible to authenticated volunteers
  - _Requirements: 7.2_

### Seeder & Pagination Tests

- [ ]* 12.18 Write feature test for DatabaseSeeder
  - Test `php artisan db:seed` runs without errors
  - Test test admin user is created with correct role
  - Test test volunteer user is created with correct role
  - Test exactly 100 volunteers are seeded
  - Test founders and heritage homes are seeded
  - _Requirements: 3.1, 3.2, 3.3, 3.4, 8.4_

- [ ]* 12.19 Write feature test for pagination on list views
  - Test admin volunteers index paginates with 15 per page
  - Test pagination links are displayed
  - Test "no records" message when list is empty
  - _Requirements: 9.1, 9.2, 9.3, 9.5_

### View Rendering Tests

- [ ]* 12.20 Write feature test for admin volunteer views rendering
  - Test admin volunteer index view renders correctly
  - Test admin volunteer create view renders form
  - Test admin volunteer edit view pre-populates data
  - Test admin volunteer show view displays correct data
  - Test admin volunteer deleted view renders soft-deleted list
  - _Requirements: 9.2, 9.3, 9.4, 9.5, 9.6_

- [ ]* 12.21 Write feature test for volunteer profile views rendering
  - Test volunteer profile show view renders correctly
  - Test volunteer profile edit view renders form with pre-populated data
  - Test volunteer dashboard view displays welcome message
  - _Requirements: 10.1, 10.2, 10.3_

### Integration & Notification Tests

- [ ]* 12.22 Write feature test for success/error flash notifications
  - Test volunteer creation displays success notification
  - Test volunteer update displays success notification
  - Test volunteer soft-delete displays success notification
  - Test volunteer restore displays success notification
  - Test invalid form submission displays error notifications
  - _Requirements: 8.6, 8.7, 8.8_

- [ ]* 12.23 Write feature test for authorization and redirect logic
  - Test volunteers accessing admin dashboard redirects to volunteer dashboard
  - Test admin accessing volunteer-only routes works correctly
  - Test unauthenticated accessing protected routes redirects to login
  - _Requirements: 1.3, 1.4_

---

## Checkpoint Tasks

- [x] 13.1 Checkpoint - Database migrations and seeders verified
  - Run `php artisan migrate:fresh --seed`
  - Verify all tables created with correct columns
  - Verify 100 volunteers seeded successfully
  - Verify test admin and volunteer users created
  - Ask the user if there are any issues to address

- [x] 13.2 Checkpoint - All models and relationships verified
  - Run model tests: `php artisan test --filter=Model tests/Unit/Models/`
  - Verify soft-delete functionality works
  - Verify relationships work correctly
  - Ask the user if there are any issues to address

- [x] 13.3 Checkpoint - Middleware protection verified
  - Test accessing admin routes without authentication redirects to login
  - Test volunteer accessing admin route redirects with error message
  - Test admin accessing admin route works correctly
  - Ask the user if there are any issues to address

- [x] 13.4 Checkpoint - Controllers and forms working
  - Run controller tests: `php artisan test --filter=Controller`
  - Test creating, updating, deleting volunteers
  - Test form validation for all required forms
  - Verify success/error notifications display
  - Ask the user if there are any issues to address

- [x] 13.5 Checkpoint - All tests passing
  - Run full test suite: `php artisan test --compact`
  - Verify no test failures
  - Verify code coverage is adequate for requirements
  - Ask the user if there are any issues before proceeding to full deployment

---

## Notes

- Tasks marked with `*` are optional and can be skipped for faster MVP delivery
- Test tasks (marked with `*`) can be deferred to a separate testing phase after core features are implemented
- Each task references specific requirements for full traceability
- Checkpoints are included to validate progress and catch issues early
- All views should maintain consistent styling with the existing TahananHeritage design
- Use Laravel's built-in notifications (Flash/Toast) for success/error messages
- Pagination consistently uses 15 records per page across all list views
- Consider running tests after each major component is complete (migrations, models, middleware, controllers)

---

## Task Dependency Graph

```json
{
  "waves": [
    {
      "id": 0,
      "tasks": ["1.1", "1.2", "1.3", "1.4"],
      "description": "Database migrations (all table modifications)"
    },
    {
      "id": 1,
      "tasks": ["1.5", "1.6", "1.7"],
      "description": "Database factories for all models"
    },
    {
      "id": 2,
      "tasks": ["2.1", "2.2", "2.3", "2.4"],
      "description": "Model updates with traits and relationships"
    },
    {
      "id": 3,
      "tasks": ["3.1", "3.2"],
      "description": "Middleware for role-based access control"
    },
    {
      "id": 4,
      "tasks": ["4.1", "4.2", "4.3", "4.4", "4.5", "4.6", "4.7"],
      "description": "Form requests for all validation rules"
    },
    {
      "id": 5,
      "tasks": ["5.1", "5.2", "5.3", "5.4", "6.1", "6.2"],
      "description": "Controllers for admin and volunteer management"
    },
    {
      "id": 6,
      "tasks": ["7.1", "7.2"],
      "description": "Route definitions with middleware protection"
    },
    {
      "id": 7,
      "tasks": ["8.1", "8.2", "8.3", "8.4"],
      "description": "Seeders for realistic test data generation"
    },
    {
      "id": 8,
      "tasks": ["9.1", "9.2", "9.3", "9.4", "9.5", "9.6", "9.7", "9.8", "9.9"],
      "description": "Admin dashboard views and components"
    },
    {
      "id": 9,
      "tasks": ["10.1", "10.2", "10.3", "10.4"],
      "description": "Volunteer dashboard views and components"
    },
    {
      "id": 10,
      "tasks": ["11.1", "11.2"],
      "description": "Authentication views design updates (optional)"
    },
    {
      "id": 11,
      "tasks": ["12.1", "12.2", "12.3", "12.4", "12.5", "12.6", "12.7", "12.8", "12.9", "12.10", "12.11", "12.12", "12.13", "12.14", "12.15", "12.16", "12.17", "12.18", "12.19", "12.20", "12.21", "12.22", "12.23"],
      "description": "Comprehensive testing of all components (optional)"
    }
  ]
}
```

---

## Implementation Guide

Each task builds on previous tasks in its wave:
1. **Wave 0**: Create database schema changes (migrations must run first)
2. **Wave 1**: Create factories (depends on migrations completing)
3. **Wave 2**: Update models with traits and relationships
4. **Wave 3**: Implement middleware for authorization
5. **Wave 4**: Create form requests for validation
6. **Wave 5**: Implement controllers (depends on models, middleware, form requests)
7. **Wave 6**: Define routes (depends on controllers, middleware)
8. **Wave 7**: Create seeders (depends on factories and models)
9. **Wave 8**: Build admin views (depends on controllers and routes)
10. **Wave 9**: Build volunteer views (depends on controllers and routes)
11. **Wave 10**: Update authentication views (optional design updates)
12. **Wave 11**: Write comprehensive tests (validates all components work together)

Begin executing tasks by opening `tasks.md` and clicking "Start task" next to each item. After each wave completes successfully, run checkpoint tasks to verify functionality before moving to the next wave.
