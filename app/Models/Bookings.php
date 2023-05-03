<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'hotel_id', 'customer_name', 'check_in_date', 'check_out_date', 'num_rooms', 'total_price'
    ];
}
