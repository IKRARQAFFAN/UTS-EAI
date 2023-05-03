<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotels;

class HotelsController extends Controller
{

    public function store(Request $request)
{

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'total_rooms' => 'required|integer',
        'facilities' => 'nullable|string',
        'price_per_night' => 'required|numeric',
    ]);

    $hotel = Hotels::create([
        'name' => $validatedData['name'],
        'location' => $validatedData['location'],
        'total_rooms' => $validatedData['total_rooms'],
        'facilities' => $validatedData['facilities'],
        'price_per_night' => $validatedData['price_per_night'],
    ]);

        if (!$hotel) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

    return response()->json([
        'message' => 'Data hotel berhasil ditambahkan',
        'data' => $hotel
    ], 201);
}

public function update(Request $request, $id)
{
    $hotel = Hotels::find($id);

    if (!$hotel) {
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'total_rooms' => 'required|integer',
        'facilities' => 'nullable|string',
        'price_per_night' => 'required|numeric',
    ]);

    $hotel->name = $validatedData['name'];
    $hotel->location = $validatedData['location'];
    $hotel->total_rooms = $validatedData['total_rooms'];
    $hotel->facilities = $validatedData['facilities'];
    $hotel->price_per_night = $validatedData['price_per_night'];
    $hotel->save();

    return response()->json([
        'message' => 'Data hotel berhasil diupdate',
        'data' => $hotel
    ], 200);
}

    public function index()
    {
        $hotels = Hotels::all();

        return response()->json([
            'data' => $hotels
        ], 200);
    }

    public function destroy($id)
    {
        $hotel = Hotels::find($id);

        if (!$hotel) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $hotel->delete();

        return response()->json([
            'message' => 'Berhasil hapus data'
        ], 200);
    }
}
