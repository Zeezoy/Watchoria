<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // GUEST
        if (!auth()->check()) {

            $query = Movie::where('status', 'completed')
                ->latest();

            if ($request->status && $request->status === 'completed') {
                $query->where('status', $request->status);
            }

            $movies = $query->get();

            return view('movies.index', compact('movies'));
        }

        // USER LOGIN
        $query = Movie::where('user_id', auth()->id())
            ->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $movies = $query->get();

        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'genre'       => 'required|string|max:100',
            'status'      => 'required|in:want to watch,watching,completed',
            'rating'      => 'nullable|numeric|min:0|max:10',
            'description' => 'nullable|string',
        ]);

        // Cek judul duplikat milik user yang sama
        $exists = Movie::whereRaw('LOWER(title) = ?', [strtolower($request->title)])
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            return back()
                ->withErrors([
                    'title' => 'Film dengan judul ini sudah ada di daftar kamu.'
                ])
                ->withInput();
        }

        Movie::create([
            'title'       => $request->title,
            'genre'       => $request->genre,
            'status'      => $request->status,
            'rating'      => $request->rating,
            'description' => $request->description,
            'user_id'     => auth()->id(),
        ]);

        return redirect()
            ->route('movies.index')
            ->with('success', 'Film berhasil ditambahkan!');
    }

    public function show(Movie $movie)
    {
        // Kalau movie milik orang lain
        if ($movie->user_id !== auth()->id()) {

            // Hanya completed yang boleh dilihat publik
            if ($movie->status !== 'completed') {
                abort(403, 'Film ini bersifat privat.');
            }
        }

        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        // Hanya pemilik movie
        if ($movie->user_id !== auth()->id()) {
            abort(403);
        }

        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        // Hanya pemilik movie
        if ($movie->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'genre'       => 'required|string|max:100',
            'status'      => 'required|in:want to watch,watching,completed',
            'rating'      => 'nullable|numeric|min:0|max:10',
            'description' => 'nullable|string',
        ]);

        // Cek judul duplikat
        $exists = Movie::whereRaw('LOWER(title) = ?', [strtolower($request->title)])
            ->where('user_id', auth()->id())
            ->where('id', '!=', $movie->id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors([
                    'title' => 'Film dengan judul ini sudah ada di daftar kamu.'
                ])
                ->withInput();
        }

        $movie->update([
            'title'       => $request->title,
            'genre'       => $request->genre,
            'status'      => $request->status,
            'rating'      => $request->rating,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('movies.index')
            ->with('success', 'Film berhasil diupdate!');
    }

    public function destroy(Movie $movie)
    {
        // Hanya pemilik movie
        if ($movie->user_id !== auth()->id()) {
            abort(403);
        }

        $movie->delete();

        return redirect()
            ->route('movies.index')
            ->with('success', 'Film berhasil dihapus!');
    }
}