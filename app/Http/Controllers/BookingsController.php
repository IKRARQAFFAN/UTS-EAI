<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Hotels;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{
    public function show($id)
    {
        // mencari id booking berdasarkan id
        $bookings = Bookings::find($id);

        // cek jika data tidak ditemukan
        if (!$bookings) {
            // tampilkan pesan error
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => []
            ], 404);
        }

        // tampilkan data booking
        return response()->json([
            'data' => $bookings
        ], 200);
    }

    public function store(Request $request)
    {
        // validasi data
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|integer|exists:hotels,id',
            'customer_name' => 'required|string|max:50',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date',
            'num_rooms' => 'required|integer',
            'total_price' => 'required|integer'
        ]);

        // cek jika validasi gagal
        if ($validator->fails()) {
            // tampilkan pesan error
            return response()->json([
                'message' => $validator->errors()
            ], 422);
        }

        // cek jika check in date lebih besar dari check out date
        if ($request->check_in_date > $request->check_out_date) {
            // tampilkan pesan error
            return response()->json([
                'message' => 'Check in date tidak boleh lebih besar dari check out date'
            ], 422);
        }

        // masukkan data ke dalam database
        $booking = Bookings::create([
            'hotel_id' => $request->hotel_id,
            'customer_name' => $request->customer_name,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'num_rooms' => $request->num_rooms,
            'total_price' => $request->total_price
        ]);

        // tampilkan pesan sukses
        return response()->json([
            'data' => $booking
        ], 201);
    }
}
