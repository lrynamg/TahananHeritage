<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FounderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $founders = [
            [
                'id' => 1,
                'founder_name' => 'Maria Santos',
                'position' => 'Founder & Executive Director',
                'image' => 'maria-santos.jpg'
            ],
            [
                'id' => 2,
                'founder_name' => 'Juan Dela Cruz',
                'position' => 'Co-Founder & Heritage Researcher',
                'image' => 'juan-dela-cruz.jpg'
            ],
            [
                'id' => 3,
                'founder_name' => 'Isabella Reyes',
                'position' => 'Cultural Heritage Specialist',
                'image' => 'isabella-reyes.jpg'
            ],
            [
                'id' => 4,
                'founder_name' => 'Gabriel Navarro',
                'position' => 'Architectural Conservationist',
                'image' => 'gabriel-navarro.jpg'
            ],
            [
                'id' => 5,
                'founder_name' => 'Sofia Mendoza',
                'position' => 'Community Outreach Director',
                'image' => 'sofia-mendoza.jpg'
            ],
            [
                'id' => 6,
                'founder_name' => 'Andres Garcia',
                'position' => 'Historical Research Coordinator',
                'image' => 'andres-garcia.jpg'
            ],
        ];

        return view('aboutus', compact('founders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
