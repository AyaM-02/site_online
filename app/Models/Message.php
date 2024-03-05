<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $guarded = [
        'id',
        'user_sender_id',
        'user_receiver_id',
    ];
    protected $fillable = [
        'text'
    ];
    public function sender()
    {
        //(een instantie van het User model) waarvan het ID overeenkomt met de waarde van sender_user_id in de huidige rij van de database. 
        //Dit wordt meestal gebruikt in situaties waarbij een object een andere entiteit heeft waarmee het verbonden is via een vreemde sleutel (foreign key) relatie.
        return $this->belongsTo(User::class, 'user_sender_id');
        //zoekt in de db naar dit user_sender_id

    }

    public function receiver()
    {
        // belongsto is een functie van laravel dat je kan gebruiken om een foreignkey op te roepen 
        return $this->belongsTo(User::class, 'user_receiver_id');
        //zoekt in de db naar dit user_receiver_id
    }
}

