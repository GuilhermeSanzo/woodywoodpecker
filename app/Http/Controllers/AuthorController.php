<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $authors = Author::paginate(10);

        if ($request->is('admin/*')) {
            return view('admin.authors.index', compact('authors'));
        }

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authors.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'pseudonym' => 'nullable|string|max:45',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birth_date' => 'required|date',
            'death_date' => 'nullable|date|after_or_equal:birth_date',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('authors', 'public');
            $validated['image'] = $path;
        }

        Author::create($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author->load('books');

        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('admin.authors.form', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'pseudonym' => 'nullable|string|max:45',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birth_date' => 'required|date',
            'death_date' => 'nullable|date|after_or_equal:birth_date',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($author->image) {
                Storage::disk('public')->delete($author->image);
            }

            $path = $request->file('image')->store('authors', 'public');
            $validated['image'] = $path;
        }

        $author->update($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        // Delete image if it exists
        if ($author->image) {
            Storage::disk('public')->delete($author->image);
        }

        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author deleted successfully.');
    }
}
