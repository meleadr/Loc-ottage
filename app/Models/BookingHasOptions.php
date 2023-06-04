<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHasOptions extends Model
{
    use HasFactory;

	protected $table = 'booking_has_options';

	protected $fillable = [
		'booking_id',
		'option_id',
	];
}
