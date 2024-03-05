<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $guarded = [
        'id',
        'deleted',
    ];
    protected $fillable = [
        'logo_file_path',
        'name',
        'link',
        'user_id',
        'visibility'
    ];
    public function leaderboard()
    {
        return $this->belongsToMany(User::class, 'game_user')
            ->withPivot('best_score', 'best_time')
            ->orderBy('best_score', 'desc') // Default order by highest score
            ->orderBy('best_time', 'asc');  // Then by fastest time
    }
}
