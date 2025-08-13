<?php

namespace App\Http\Controllers;

use App\Models\Crossing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrossingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crossings = Crossing::latest()->paginate(10);
        return view('crossings.index', compact('crossings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crossings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:20|unique:crossings',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Crossing::create($request->all());

        return redirect()->route('crossings.index')
            ->with('success', 'Perlintasan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Crossing $crossing)
    {
        return view('crossings.show', compact('crossing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crossing $crossing)
    {
        return view('crossings.edit', compact('crossing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crossing $crossing)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:20|unique:crossings,code,'.$crossing->id,
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $crossing->update($request->all());

        return redirect()->route('crossings.index')
            ->with('success', 'Perlintasan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crossing $crossing)
    {
        $crossing->delete();
        return redirect()->route('crossings.index')
            ->with('success', 'Perlintasan berhasil dihapus (soft delete)');
    }
}