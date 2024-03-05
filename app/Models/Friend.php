<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $table = 'friends';

    protected $guarded = [
        'id',
        'user_sender_id',
        'ontvanger_id',
        'status',
        'date_accepted',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_sender_id');
        //users heb je user ids == user_sender_id en zo kan die aan de info zoals name
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'ontvanger_id');
    }
}
