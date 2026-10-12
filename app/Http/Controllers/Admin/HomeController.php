<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController
{
    public function index(): View
    {
        $homes = Home::paginate(15);

        return view('admin.homes.index', compact('homes'));
    }

    public function create(): View
    {
        return view('admin.homes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'house_name' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'img_url' => 'nullable|url|max:255',
        ]);

        Home::create($validated);

        return redirect()->route('admin.homes.index')
            ->with('success', 'Home created successfully!');
    }

    public function show(string $id): View
    {
        $home = Home::findOrFail($id);

        return view('admin.homes.show', compact('home'));
    }

    public function edit(string $id): View
    {
        $home = Home::findOrFail($id);

        return view('admin.homes.edit', compact('home'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'house_name' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'img_url' => 'nullable|url|max:255',
        ]);

        $home = Home::findOrFail($id);
        $home->update($validated);

        return redirect()->route('admin.homes.index')
            ->with('success', 'Home updated successfully!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $home = Home::findOrFail($id);
        $home->delete();

        return redirect()->route('admin.homes.index')
            ->with('success', 'Home deleted successfully!');
    }

    public function showDeleted(): View
    {
        $homes = Home::onlyTrashed()->paginate(15);

        return view('admin.homes.deleted', compact('homes'));
    }

    public function restore(int $id): RedirectResponse
    {
        $home = Home::onlyTrashed()->findOrFail($id);
        $home->restore();

        return redirect()->route('admin.homes.index')
            ->with('success', 'Home restored successfully!');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $home = Home::onlyTrashed()->findOrFail($id);
        $home->forceDelete();

        return redirect()->route('admin.homes.index')
            ->with('success', 'Home permanently deleted!');
    }
}
