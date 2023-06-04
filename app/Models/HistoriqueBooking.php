<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueBooking extends Model
{
    use HasFactory;

	protected $table = 'historique_bookings';

	protected $fillable = [
		'id_user',
		'id_booking',
		'id_status_before',
		'id_status_after',
	];
}
