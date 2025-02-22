<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Models\Province;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::all();
        return view('index', compact('provinces'));
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
    public function store(StoreProvinceRequest $request)
    {
        $request->validate([
            'province' => 'required|string|max:255|unique:provinces,name',
        ]);

        try {
            Province::create([
                'name' => $request->province,
            ]);

            return redirect()->back()->with('success', 'Provinsi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan provinsi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province)
    {
        $provinces = Province::all();

        return view('index', compact('province', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
        $request->validate([
            'province' => 'required|string|max:255|unique:provinces,name,' . $province->id,
        ]);

        try {
            $province->update(['name' => $request->province]);

            return redirect()->back()->with('success', 'Provinsi berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah provinsi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        try {
            $province->delete();

            return redirect()->route('province.index')->with('success', 'Provinsi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah provinsi: ' . $e->getMessage());
        }

    }
}
