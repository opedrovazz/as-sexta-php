<?php
namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        return response()->json(Artist::with('artworks')->get());
    }

    public function store(Request $request)
    {
        $artist = Artist::create($request->all());
        return response()->json($artist, 201);
    }

    public function show($id)
    {
        $artist = Artist::with('artworks')->findOrFail($id);
        return response()->json($artist);
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);
        $artist->update($request->all());
        return response()->json($artist);
    }

    public function destroy($id)
    {
        Artist::destroy($id);
        return response()->json(null, 204);
    }
}
