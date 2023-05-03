<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name', 'location', 'total_rooms', 'facilities', 'price_per_night'
    ];
}
