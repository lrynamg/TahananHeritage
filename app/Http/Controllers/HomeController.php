<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heritageHomes = [
            [
                'id' => 1,
                'home_name' => 'Casa Manila',
                'location' => 'Intramuros, Manila',
                'image' => 'casa-manila.jpg'
            ],
            [
                'id' => 2,
                'home_name' => 'Yap-Sandiego Ancestral House',
                'location' => 'Cebu City, Cebu',
                'image' => 'yap-sandiego.jpg'
            ],
            [
                'id' => 3,
                'home_name' => 'Balay Negrense',
                'location' => 'Silay City, Negros Occidental',
                'image' => 'balay-negrense.jpg'
            ],
            [
                'id' => 4,
                'home_name' => 'Malanang House',
                'location' => 'Molo, Iloilo City',
                'image' => 'malanang-house.jpg'
            ],
            [
                'id' => 5,
                'home_name' => 'Syquia Mansion Museum',
                'location' => 'Vigan City, Ilocos Sur',
                'image' => 'syquia-mansion.jpg'
            ],
            [
                'id' => 6,
                'home_name' => 'Haw-Ay Ancestral House',
                'location' => 'Vigan City, Ilocos Sur',
                'image' => 'haw-ay-house.jpg'
            ],
        ];

        return view('ancestralhome', compact('heritageHomes'));
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
        $heritageHomes = [
            ['id' => 1, 'home_name' => 'Casa Manila', 'location' => 'Intramuros, Manila', 'image' => 'casa-manila.jpg'],
            ['id' => 2, 'home_name' => 'Yap-Sandiego Ancestral House', 'location' => 'Cebu City, Cebu', 'image' => 'yap-sandiego.jpg'],
            ['id' => 3, 'home_name' => 'Balay Negrense', 'location' => 'Silay City, Negros Occidental', 'image' => 'balay-negrense.jpg'],
            ['id' => 4, 'home_name' => 'Malanang House', 'location' => 'Molo, Iloilo City', 'image' => 'malanang-house.jpg'],
            ['id' => 5, 'home_name' => 'Syquia Mansion Museum', 'location' => 'Vigan City, Ilocos Sur', 'image' => 'syquia-mansion.jpg'],
            ['id' => 6, 'home_name' => 'Haw-Ay Ancestral House', 'location' => 'Vigan City, Ilocos Sur', 'image' => 'haw-ay-house.jpg'],
        ];

        // Find the home by ID
        $home = collect($heritageHomes)->firstWhere('id', $id);

        if (!$home) {
            abort(404); // show 404 if not found
        }

        return view('homeParameter', compact('home'));
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
