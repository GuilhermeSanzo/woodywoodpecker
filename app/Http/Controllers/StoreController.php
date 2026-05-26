<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Store::latest();

        if ($request->is('admin/*') && $request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('city', 'LIKE', "%{$searchTerm}%");
        }

        $stores = $query->paginate(10);

        if ($request->is('admin/*')) {
            return view('admin.stores.index', compact('stores'));
        }

        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stores.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'street_type' => 'required|string|max:10',
            'address' => 'required|string|max:100',
            'number' => 'required|string|max:9',
            'neighborhood' => 'required|string|max:45',
            'city' => 'required|string|max:45',
            'state' => 'required|string|size:2',
        ]);

        Store::create($validated);

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        return view('stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        return view('admin.stores.form', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'street_type' => 'required|string|max:10',
            'address' => 'required|string|max:100',
            'number' => 'required|string|max:9',
            'neighborhood' => 'required|string|max:45',
            'city' => 'required|string|max:45',
            'state' => 'required|string|size:2',
        ]);

        $store->update($validated);

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store deleted successfully.');
    }
}
