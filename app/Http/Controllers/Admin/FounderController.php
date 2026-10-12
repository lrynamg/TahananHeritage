<?php

namespace App\Http\Controllers\Admin;

use App\Models\Founder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FounderController
{
    public function index(): View
    {
        $founders = Founder::paginate(15);

        return view('admin.founders.index', compact('founders'));
    }

    public function create(): View
    {
        return view('admin.founders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'img_url' => 'nullable|url|max:255',
        ]);

        Founder::create($validated);

        return redirect()->route('admin.founders.index')
            ->with('success', 'Founder created successfully!');
    }

    public function show(string $id): View
    {
        $founder = Founder::findOrFail($id);

        return view('admin.founders.show', compact('founder'));
    }

    public function edit(string $id): View
    {
        $founder = Founder::findOrFail($id);

        return view('admin.founders.edit', compact('founder'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'img_url' => 'nullable|url|max:255',
        ]);

        $founder = Founder::findOrFail($id);
        $founder->update($validated);

        return redirect()->route('admin.founders.index')
            ->with('success', 'Founder updated successfully!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $founder = Founder::findOrFail($id);
        $founder->delete();

        return redirect()->route('admin.founders.index')
            ->with('success', 'Founder deleted successfully!');
    }

    public function showDeleted(): View
    {
        $founders = Founder::onlyTrashed()->paginate(15);

        return view('admin.founders.deleted', compact('founders'));
    }

    public function restore(int $id): RedirectResponse
    {
        $founder = Founder::onlyTrashed()->findOrFail($id);
        $founder->restore();

        return redirect()->route('admin.founders.index')
            ->with('success', 'Founder restored successfully!');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $founder = Founder::onlyTrashed()->findOrFail($id);
        $founder->forceDelete();

        return redirect()->route('admin.founders.index')
            ->with('success', 'Founder permanently deleted!');
    }
}
