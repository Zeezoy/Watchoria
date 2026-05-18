<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('movies.create');
         dd('CREATE WORKS');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'status' => 'required|in:want to watch,watching,completed',
            'rating' => 'nullable|numeric|min:0|max:10',
            'description' => 'nullable|string',
        ]);

        Movie::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'status' => $request->status,
            'rating' => $request->rating,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('movies.index')
        ->with('success', 'Film berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
        'title'         => 'required|string|max:255',
        'genre'         => 'required|string|max:100',
        'status'        => 'required|in:want to watch,watching,completed',
        'rating'        => 'nullable|numeric|min:0|max:10',
        'description'   => 'nullable|string',  
        ]);

        $movie->update($request->only(
            'title', 'genre', 'status', 'rating', 'description'
        ));

        return redirect()->route('movies.show', $movie)
        ->with('success', 'Film berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')
        ->with('success', 'Film berhasil dihapus!');
    }
}
