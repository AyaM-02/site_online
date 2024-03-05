<?php

namespace App\Services;

use App\Http\Models\Participation;

class ParticipationService extends Service
{
    public function createParticipation($userId, $gameId, $accessToken)
    {
        // Validatie van invoer zou hier moeten plaatsvinden

        return Participation::create([
            'user_id' => $userId,
            'game_id' => $gameId,
            'access_token' => $accessToken,
        ]);
    }

    public function getAllParticipations()
    {
        return Participation::all();
    }

    public function getParticipation($participationId)
    {
        return Participation::find($participationId);
    }

    // Voeg hier andere methoden toe zoals bijwerken, verwijderen, etc. afhankelijk van de vereisten van je applicatie.
}

