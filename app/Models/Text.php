<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    protected $table = 'texts';

    protected $fillable = [
        'user_name',
        'title',
        'content',
        'file_path',
        'file_type'
    ];
}
