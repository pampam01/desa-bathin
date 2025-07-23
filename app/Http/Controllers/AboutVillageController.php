<?php

namespace App\Http\Controllers;

use App\Models\AboutVillage;
use Illuminate\Http\Request;

class AboutVillageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutVillage = AboutVillage::first();
        // if (!$aboutVillage) {
        //     return redirect()->route('aboutvillage.create')->with('info', 'Silakan buat informasi tentang desa terlebih dahulu.');
        // }
        $totalPeople = $aboutVillage->people_total ?? 0;
        $totalFamilies = $aboutVillage->family_total ?? 0;
        $totalBloks = $aboutVillage->blok_total ?? 0;
        $totalPrograms = $aboutVillage->program_total ?? 0;
        $description = $aboutVillage->description ?? '';
        $visi = $aboutVillage->visi ?? '';
        $misi = $aboutVillage->misi ?? '';
        $location = $aboutVillage->location ?? '';
        $telp = $aboutVillage->no_telp ?? '';
        $email = $aboutVillage->email ?? '';

        return view('backend.admin.aboutvillage.index', compact('aboutVillage', 'totalPeople', 'totalFamilies', 'totalBloks', 'totalPrograms', 'description', 'visi', 'misi', 'location', 'telp', 'email'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.aboutvillage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'people_total' => 'nullable|integer|min:0',
            'family_total' => 'nullable|integer|min:0',
            'blok_total' => 'nullable|integer|min:0',
            'program_total' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'location' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255'
        ]);

        AboutVillage::create($validatedData);

        return redirect()->route('aboutvillage.index')
            ->with('success', 'Informasi desa berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutVillage $aboutVillage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutVillage $aboutVillage, $id)
    {
        $aboutVillage = AboutVillage::findOrFail($id);
        return view('backend.admin.aboutvillage.edit', compact('aboutVillage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutVillage $aboutVillage, $id)
    {
        $aboutVillage = AboutVillage::findOrFail($id);
        
        $validatedData = $request->validate([
            'people_total' => 'nullable|integer|min:0',
            'family_total' => 'nullable|integer|min:0',
            'blok_total' => 'nullable|integer|min:0',
            'program_total' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'location' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255'
        ]);

        $aboutVillage->update($validatedData);

        return redirect()->route('aboutvillage.index')
            ->with('success', 'Informasi desa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutVillage $aboutVillage)
    {
        //
    }
}
