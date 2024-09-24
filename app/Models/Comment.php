<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'article_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // public function shortDiffForHumans()
    // {
    //     $date = $this->created_at;
    //     $diff = $date->diffInSeconds(Carbon::now());

    //     if ($diff < 60) {
    //         return $diff . 's ago'; // Detik
    //     } elseif ($diff < 3600) {
    //         return $date->diffInMinutes(Carbon::now()) . 'm ago'; // Menit
    //     } elseif ($diff < 86400) {
    //         return $date->diffInHours(Carbon::now()) . 'h ago'; // Jam
    //     } else {
    //         return $date->diffInDays(Carbon::now()) . 'd ago'; // Hari
    //     }
    // }
}
