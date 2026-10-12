<?php

namespace App\Http\Controllers\Admin;

use App\Models\Volunteer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VolunteerController
{
    /**
     * Display a paginated list of active volunteers (15 per page)
     */
    public function index(): View
    {
        $volunteers = Volunteer::paginate(15);

        return view('admin.volunteers.index', compact('volunteers'));
    }

    /**
     * Display specific volunteer details
     */
    public function show(Volunteer $volunteer): View
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    /**
     * Display volunteer creation form
     */
    public function create(): View
    {
        return view('admin.volunteers.create');
    }

    /**
     * Store a newly created volunteer with validation
     */
    public function store(): RedirectResponse
    {
        $validated = request()->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:volunteers,email|max:255',
            'phone_number' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20',
        ]);

        Volunteer::create($validated);

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer created successfully.');
    }

    /**
     * Display edit form with pre-populated data
     */
    public function edit(Volunteer $volunteer): View
    {
        return view('admin.volunteers.edit', compact('volunteer'));
    }

    /**
     * Update volunteer with validation
     */
    public function update(Volunteer $volunteer): RedirectResponse
    {
        $validated = request()->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:volunteers,email,'.$volunteer->id.'|max:255',
            'phone_number' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20',
        ]);

        $volunteer->update($validated);

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer updated successfully.');
    }

    /**
     * Soft-delete a volunteer
     */
    public function destroy(Volunteer $volunteer): RedirectResponse
    {
        $volunteer->delete();

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer deleted successfully.');
    }

    /**
     * List soft-deleted volunteers with pagination
     */
    public function showDeleted(): View
    {
        $volunteers = Volunteer::onlyTrashed()->paginate(15);

        return view('admin.volunteers.deleted', compact('volunteers'));
    }

    /**
     * Restore a soft-deleted volunteer by ID
     */
    public function restore(int $id): RedirectResponse
    {
        $volunteer = Volunteer::onlyTrashed()->findOrFail($id);
        $volunteer->restore();

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer restored successfully.');
    }

    /**
     * Permanently delete a soft-deleted volunteer
     */
    public function forceDelete(int $id): RedirectResponse
    {
        $volunteer = Volunteer::onlyTrashed()->findOrFail($id);
        $volunteer->forceDelete();

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer permanently deleted.');
    }
}
