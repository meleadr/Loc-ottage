<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cottage extends Model
{
    use HasFactory;

    protected $table = 'locottage';

    // Définis les colonnes que tu souhaites utiliser
    protected $fillable = ['name', 'area', 'bedrooms', 'persons', 'description', 'price', 'image_url'];
}
