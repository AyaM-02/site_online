<?php

namespace App\Services;

use App\Models\User;

class UserService extends Service
{

  public function findAll($filter) {
    //return User::where('deleted', false)->get();
    return User::all();
  }

  public function getStatistics() {
  }

  public function getLeaderboard() {
  }

    public function sendFriendRequest($userSenderId, $userReceivedId)
    {

    }

}
