<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class achievement extends Model
{
    use HasFactory;
    protected $table = 'achievements';
    protected $guarded = [
        'achievement_id',
        'user_id'

    ];
    protected $fillable = [
        'title',
        'picture_url',
        'achievement_date'
    ];


}
