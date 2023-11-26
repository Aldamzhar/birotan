<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Songs extends Model
{
    use HasFactory;

    protected $fillable = [
        'youtube_link',
        'title',
        'publication_date',
        'author_name',
        'description'
    ];

    public function extractVideoId($url) {
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
            return $id[1];
        } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
            return $id[1];
        } elseif (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
            return $id[1];
        } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
            return $id[1];
        } else {
            Session::flash('error', 'Invalid YouTube link provided.');
        }
        return null;
    }

    public function getYouTubeThumbnailUrl($url) {
        $videoId = $this->extractVideoId($url);
        if ($videoId) {
            // Return the URL for the highest resolution thumbnail image
            return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
        } else {
            Session::flash('error', 'No thumbnail provided');

        }
        return null;
    }
}
