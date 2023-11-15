<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalysisResult extends Model
{
    use HasFactory;

    protected $table = 'analysis_results';

    protected $fillable = [
        'text_id',
        'total_words',
        'unique_words',
        'unique_percentage'
    ];

    public function text(): BelongsTo
    {
        return $this->belongsTo(Text::class, 'text_id');
    }
}
