<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    // Définis les colonnes que tu souhaites utiliser
    protected $fillable = ['cottage_id', 'user_id', 'start_date', 'end_date', 'persons', 'price'];
}
