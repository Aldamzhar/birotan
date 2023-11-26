<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baskat extends Model
{
    use HasFactory;

    protected $fillable = [
        'word'
    ];
}
