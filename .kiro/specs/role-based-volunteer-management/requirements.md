# Requirements: Role-Based Volunteer Management & Refactoring

## Introduction

The TahananHeritage application is a Laravel web platform that showcases Philippine heritage homes. This refactoring implements a comprehensive role-based access control system with two distinct roles (Admin and Volunteer), introduces soft-delete functionality across all records, establishes proper data relationships, and provides realistic seeded volunteer data. The implementation aligns with a grading rubric covering 100 points across models, database, views, authentication, validation, and data management.

## Glossary

- **Admin**: User role with full access to all application features, including creating, editing, deleting, and restoring records across Volunteers, Founders, and Heritage Homes.
- **Volunteer**: User role with restricted access; can view limited pages and edit only their own volunteer profile within the Manage Volunteer section.
- **Heritage Home**: A historical property in the Philippines that is documented in the application database.
- **Founder**: A person who contributed to the creation or preservation of heritage homes.
- **Middleware**: Laravel code executed before a request reaches a controller, used here to enforce role-based access control.
- **Soft Delete**: Marking a record as deleted without removing it from the database; records retain `deleted_at` timestamp.
- **Restore**: Reversing a soft delete operation to make a record active again.
- **Permanent Delete**: Irreversible removal of a record from the database.
- **Seeder**: A Laravel database utility that generates and inserts sample data into the database.
- **Form Request**: Laravel validation class that encapsulates request validation rules and authorization logic.
- **Pagination**: Splitting large datasets into manageable pages.
- **Relationship**: Database association between models (e.g., one-to-many, many-to-many).
- **Eloquent Resource**: Laravel API resource class that formats model data for API responses.

## Requirements

### Requirement 1: Role-Based Access Control

**User Story:** As an application administrator, I want to enforce role-based access control, so that volunteers have limited access to sensitive pages and only authorized users can perform administrative actions.

#### Acceptance Criteria

1. THE System SHALL authenticate users during login with email and password credentials.
2. THE User_Role_System SHALL assign each user either the "Admin" or "Volunteer" role upon creation.
3. WHEN a Volunteer attempts to access an admin page (e.g., dashboard, manage volunteers, manage founders, manage homes), THE Access_Control_Middleware SHALL redirect them to the volunteer dashboard with an error notification.
4. WHEN an Admin accesses any administrative page, THE Access_Control_Middleware SHALL allow the request to proceed.
5. WHEN a Volunteer accesses the "Manage Volunteer" page, THE System SHALL display only their own volunteer profile, allowing edits exclusively to their own data.
6. WHEN an Admin accesses the "Manage Volunteer" page, THE System SHALL display a list of all volunteers with options to create, edit, delete (soft), restore, and permanently delete records.
7. THE Access_Control_Middleware SHALL be implemented as a custom middleware class that checks the authenticated user's role attribute.

### Requirement 2: Database Models & Relationships

**User Story:** As a developer, I want properly structured Eloquent models with established relationships and soft-delete capability, so that the application can efficiently manage related data across Volunteers, Founders, and Heritage Homes.

#### Acceptance Criteria

1. THE Volunteer Model SHALL include properties: `first_name`, `last_name`, `email`, `phone_number`, and soft-delete support.
2. THE Founder Model SHALL include properties: `first_name`, `last_name`, `position`, `img_url`, and soft-delete support.
3. THE Home Model SHALL include properties: `house_name`, `location`, `img_url`, and soft-delete support.
4. EACH Model SHALL implement Laravel's SoftDeletes trait to support soft-delete, restore, and permanent-delete operations.
5. EACH Model's fillable array SHALL explicitly list all user-assignable properties.
6. THE Volunteer, Founder, and Home Models SHALL be related through appropriate Eloquent relationships (e.g., a User may have many Volunteers).
7. IF a relationship is needed, THE User Model SHALL have a `role` attribute (e.g., 'admin' or 'volunteer') to distinguish user types.

### Requirement 3: Volunteer Data Seeding

**User Story:** As a database administrator, I want to populate the application with realistic volunteer data, so that testing and demonstration can proceed without manual data entry.

#### Acceptance Criteria

1. THE VolunteerSeeder SHALL generate exactly 100 volunteer records using Laravel's Faker library.
2. EACH seeded volunteer record SHALL include:
   - A realistic first name (using Faker's `firstName()` method)
   - A realistic last name (using Faker's `lastName()` method)
   - A unique email address (using Faker's `unique()->safeEmail()` method)
   - A realistic Philippine phone number (using Faker's `phoneNumber()` method)
3. THE VolunteerSeeder SHALL be called from the main DatabaseSeeder when the application is seeded.
4. WHEN `php artisan db:seed` is executed, THE System SHALL successfully insert 100 volunteer records without errors.
5. THE Volunteer factory SHALL support generating individual volunteer records with customizable attributes for testing purposes.

### Requirement 4: Soft Deletes, Restore & Permanent Delete Operations

**User Story:** As an administrator, I want to soft-delete records while preserving data integrity, and restore or permanently delete records as needed, so that I can manage data lifecycle safely.

#### Acceptance Criteria

1. WHEN an Admin soft-deletes a Volunteer, Founder, or Home record via the UI or API, THE System SHALL mark the record with a `deleted_at` timestamp without removing it from the database.
2. WHEN an Admin soft-deletes a Volunteer, Founder, or Home record, THE System SHALL hide the record from standard list views by default.
3. WHEN viewing records with soft-delete capability, THE Admin Dashboard SHALL display a filter or tab to show "Deleted Records" separately.
4. WHEN an Admin selects "Restore" on a soft-deleted record, THE System SHALL clear the `deleted_at` timestamp and make the record active again.
5. WHEN an Admin selects "Permanently Delete," THE System SHALL display a confirmation dialog warning of irreversible data loss.
6. WHEN confirmed, THEN THE System SHALL permanently remove the record from the database.
7. THE Volunteer, Founder, and Home Models SHALL all implement the SoftDeletes trait.
8. THE User Model SHALL also implement SoftDeletes to support volunteer account deactivation with recovery options.

### Requirement 5: Admin Dashboard Views

**User Story:** As an admin, I want a dedicated dashboard with organized navigation and management pages, so that I can efficiently manage all application data.

#### Acceptance Criteria

1. THE Admin Dashboard SHALL display a main overview page upon login.
2. THE Admin Dashboard SHALL include a navigation menu with links to:
   - Manage Volunteers
   - Manage Founders
   - Manage Heritage Homes (Houses)
3. THE "Manage Volunteers" page SHALL display a paginated list of all volunteers (excluding soft-deleted records by default).
4. THE "Manage Volunteers" page SHALL provide action buttons for:
   - View volunteer details
   - Edit volunteer profile
   - Soft-delete volunteer
   - Restore soft-deleted volunteer (when applicable)
   - Permanently delete volunteer (with confirmation)
5. THE "Manage Founders" page SHALL follow the same structure as Manage Volunteers, displaying all founders with full CRUD operations.
6. THE "Manage Heritage Homes" page SHALL display all heritage homes with options to:
   - Create a new heritage home
   - Edit heritage home details
   - Soft-delete a heritage home
   - Restore a soft-deleted heritage home
   - Permanently delete a heritage home
7. EACH management page SHALL include pagination with configurable page size (e.g., 15 records per page).

### Requirement 6: Volunteer Dashboard Views

**User Story:** As a volunteer, I want a dedicated dashboard with restricted access to only my own profile, so that I can maintain my volunteer information securely.

#### Acceptance Criteria

1. THE Volunteer Dashboard SHALL display upon login with a welcome message and limited navigation options.
2. THE Volunteer Dashboard navigation menu SHALL include:
   - My Profile (limited to their own data)
   - Logout
3. WHEN a Volunteer accesses "My Profile," THE System SHALL display only their own volunteer record with editable fields.
4. WHEN a Volunteer updates their profile, THE System SHALL validate the input using Form Request validation rules.
5. WHEN profile updates are successful, THE System SHALL display a success notification and redirect to the Volunteer Dashboard.
6. THE Volunteer Dashboard SHALL prevent access to admin pages through middleware enforcement.

### Requirement 7: Create, Edit & Delete Views

**User Story:** As an admin, I want dedicated pages (not modals) for creating and editing records, so that I have a clear, focused interface for data entry and modification.

#### Acceptance Criteria

1. THE "Create Volunteer" page SHALL be located at `/volunteers/create` and display a form with fields for:
   - First Name
   - Last Name
   - Email
   - Phone Number
2. THE "Edit Volunteer" page SHALL be located at `/volunteers/{id}/edit` and pre-populate the form with existing volunteer data.
3. THE "Create Founder" page SHALL follow the same structure as volunteers, with fields for:
   - First Name
   - Last Name
   - Position
   - Image URL
4. THE "Edit Founder" page SHALL be located at `/founders/{id}/edit` with pre-populated data.
5. THE "Create Heritage Home" page SHALL display a form with fields for:
   - House Name
   - Location
   - Image URL
6. THE "Edit Heritage Home" page SHALL be located at `/homes/{id}/edit` with pre-populated data.
7. EACH form page SHALL include:
   - A form with all required fields
   - Client-side and server-side validation feedback
   - A submit button
   - A cancel button that returns to the previous page
8. EACH form page SHALL be organized in a dedicated folder structure (e.g., `resources/views/admin/volunteers/create.blade.php`).

### Requirement 8: Form Validation & Notifications

**User Story:** As a user, I want real-time validation feedback and clear success/error notifications, so that I can correct form errors efficiently and understand the outcome of my actions.

#### Acceptance Criteria

1. THE System SHALL validate all required form fields on the server side using Laravel Form Requests.
2. THE Volunteer form SHALL validate:
   - `first_name`: Required, max 100 characters
   - `last_name`: Required, max 100 characters
   - `email`: Required, unique email format, unique in the database
   - `phone_number`: Required, valid phone number format
3. THE Founder form SHALL validate:
   - `first_name`: Required, max 100 characters
   - `last_name`: Required, max 100 characters
   - `position`: Required, max 150 characters
   - `img_url`: Optional, valid URL format
4. THE Heritage Home form SHALL validate:
   - `house_name`: Required, max 200 characters
   - `location`: Required, max 200 characters
   - `img_url`: Optional, valid URL format
5. WHEN form validation fails, THE System SHALL display field-specific error messages to the user.
6. WHEN an action (create, update, delete, restore) is successful, THE System SHALL display a success notification (e.g., "Volunteer created successfully").
7. WHEN an action fails, THE System SHALL display an error notification with a descriptive message.
8. THE System SHALL use Laravel's session-based flash notifications (or Toastr/similar) for displaying notifications.

### Requirement 9: Pagination & Relationships

**User Story:** As an admin managing large datasets, I want paginated lists with proper relationships displayed, so that the interface remains responsive and I can navigate through records efficiently.

#### Acceptance Criteria

1. THE "Manage Volunteers" page SHALL paginate volunteer records with 15 records per page by default.
2. THE "Manage Founders" page SHALL paginate founder records with 15 records per page by default.
3. THE "Manage Heritage Homes" page SHALL paginate heritage home records with 15 records per page by default.
4. EACH paginated list SHALL display pagination links (previous, numbered pages, next) at the bottom of the table.
5. IF relationships exist between models, THEN related data SHALL be loaded using Eloquent's eager-loading (`with()` method) to prevent N+1 query problems.
6. THE Heritage Homes list MAY display associated Founder or volunteer information if a relationship is established.
7. THE System SHALL display a "No records found" message when a paginated list contains no results.

### Requirement 10: Authentication Design Update (Bonus)

**User Story:** As a user, I want login and registration pages that visually align with the heritage home website design, so that the authentication flow feels consistent with the application brand.

#### Acceptance Criteria

1. THE Login page SHALL maintain its current functionality (no logic changes) while adopting the website's heritage home design aesthetic.
2. THE Register page SHALL maintain its current functionality while matching the login page's design theme.
3. THE pages SHALL incorporate:
   - Heritage-inspired color scheme (e.g., earth tones, traditional Philippine colors)
   - Consistent branding and typography with the main website
   - Responsive layout for mobile and desktop viewing
4. THIS requirement is design-only; no authentication logic modifications are required.

### Requirement 11: Database Migrations & Soft Deletes

**User Story:** As a developer, I want database migrations with soft-delete support for all models, so that the database schema properly supports data lifecycle management.

#### Acceptance Criteria

1. THE Volunteer migration SHALL include a `deleted_at` nullable timestamp column.
2. THE Founder migration SHALL include a `deleted_at` nullable timestamp column.
3. THE Home migration SHALL include a `deleted_at` nullable timestamp column.
4. THE User migration SHALL include a `deleted_at` nullable timestamp column and a `role` column (enum with values 'admin' or 'volunteer').
5. WHEN migrations are run, THE System SHALL successfully create all necessary columns without errors.

### Requirement 12: Seeder & Factory Integration

**User Story:** As a developer, I want factories and seeders for all models, so that I can generate realistic test data efficiently.

#### Acceptance Criteria

1. EACH model (Volunteer, Founder, Home) SHALL have a corresponding Factory class.
2. THE VolunteerFactory SHALL generate realistic volunteer data using Faker methods.
3. THE FounderFactory SHALL generate realistic founder data using Faker methods.
4. THE HomeFactory SHALL generate realistic heritage home data using Faker methods.
5. THE DatabaseSeeder SHALL call all individual seeders in proper order (Founders, Homes, Volunteers, Users).
6. WHEN the DatabaseSeeder is executed, THE System SHALL populate the database with seed data without errors.

### Requirement 13: HomeController Heritage Home Management

**User Story:** As an administrator, I want the HomeController to properly manage heritage home records with CRUD operations and role-based access, so that heritage homes are maintained consistently.

#### Acceptance Criteria

1. THE HomeController index method SHALL retrieve all heritage homes (excluding soft-deleted by default) and display them on the admin page.
2. THE HomeController show method SHALL retrieve a specific heritage home by ID.
3. THE HomeController create method SHALL display the form to create a new heritage home.
4. THE HomeController store method SHALL validate input via Form Request and create a new heritage home record.
5. THE HomeController edit method SHALL retrieve a heritage home and display the edit form.
6. THE HomeController update method SHALL validate input and update the heritage home record.
7. THE HomeController destroy method SHALL soft-delete a heritage home record.
8. THE HomeController SHALL include methods to:
   - Restore a soft-deleted heritage home
   - Permanently delete a heritage home (with confirmation)
   - Display a list including soft-deleted records (for admin review)
9. ALL HomeController routes SHALL be protected by the Admin role middleware.

---

## Summary

This requirements document covers the complete refactoring of the TahananHeritage application to implement role-based access control, proper data management with soft deletes, comprehensive CRUD operations, realistic data seeding, and aligned authentication design. All 13 requirements are structured following EARS patterns and INCOSE quality standards, ensuring testability, clarity, and completeness aligned with the grading rubric (100 points total).

