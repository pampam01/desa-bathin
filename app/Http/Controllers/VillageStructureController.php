<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VillageStructure;
use Illuminate\Support\Facades\Storage;

class VillageStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = VillageStructure::orderBy('sort_order')->get();
        return view('backend.admin.villagestructure.index', compact('structures'));
    }

    /**
     * Show the form for creating a new resource.
     * DISABLED: Edit-only management
     */
    public function create()
    {
        abort(404, 'Pembuatan data baru tidak diizinkan. Gunakan fitur edit untuk mengubah data yang sudah ada.');
    }

    /**
     * Store a newly created resource in storage.
     * DISABLED: Edit-only management
     */
    public function store(Request $request)
    {
        abort(404, 'Pembuatan data baru tidak diizinkan. Gunakan fitur edit untuk mengubah data yang sudah ada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VillageStructure $villagestructure)
    {
        return view('backend.admin.villagestructure.show', compact('villagestructure'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VillageStructure $villagestructure)
    {
        // Pass the structure with alias for consistency
        $structure = $villagestructure;
        return view('backend.admin.villagestructure.edit', compact('structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VillageStructure $villagestructure)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'sort_order' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($villagestructure->photo) {
                Storage::disk('public')->delete($villagestructure->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('village-structure', 'public');
        }

        $villagestructure->update($validatedData);

        return redirect()->route('villagestructure.index')
            ->with('success', 'Data pejabat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     * DISABLED: Edit-only management
     */
    public function destroy(VillageStructure $villagestructure)
    {
        abort(404, 'Penghapusan data tidak diizinkan. Ubah status menjadi "Tidak Aktif" jika diperlukan.');
    }
}
