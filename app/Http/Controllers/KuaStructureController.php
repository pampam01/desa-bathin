<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KuaStructure;
use Illuminate\Support\Facades\Storage;

class KuaStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = KuaStructure::orderBy('sort_order')->get();
        return view('backend.admin.kuastructure.index', compact('structures'));
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
    public function show(KuaStructure $kuastructure)
    {
        return view('backend.admin.kuastructure.show', compact('kuastructure'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KuaStructure $kuastructure)
    {
        // Pass the structure with alias for consistency
        $structure = $kuastructure;
        return view('backend.admin.kuastructure.edit', compact('structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KuaStructure $kuastructure)
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
            if ($kuastructure->photo) {
                Storage::disk('public')->delete($kuastructure->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('kua-structure', 'public');
        }

        $kuastructure->update($validatedData);

        return redirect()->route('kuastructure.index')
            ->with('success', 'Data pejabat KUA berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     * DISABLED: Edit-only management
     */
    public function destroy(KuaStructure $kuastructure)
    {
        abort(404, 'Penghapusan data tidak diizinkan. Ubah status menjadi "Tidak Aktif" jika diperlukan.');
    }
}
