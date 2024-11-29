<?php
namespace App\Http\Controllers;


use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index()
    {
        return response()->json(Artwork::with('artist')->get());
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('artworks', 'public');
            $data['image_path'] = $path;
        }

        $artwork = Artwork::create($data);
        return response()->json($artwork, 201);
    }

    public function show($id)
    {
        $artwork = Artwork::with('artist')->findOrFail($id);
        return response()->json($artwork);
    }

    public function update(Request $request, $id)
    {
        $artwork = Artwork::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($artwork->image_path) {
                Storage::delete($artwork->image_path);
            }

            $path = $request->file('image')->store('artworks', 'public');
            $request->merge(['image_path' => $path]);
        }

        $artwork->update($request->all());
        return response()->json($artwork);
    }

    public function destroy($id)
    {
        Artwork::destroy($id);
        return response()->json(null, 204);
    }
}
