<?php

namespace App\Services;

use App\Models\Message;

class MessageService extends Service
{

  public function findAll($filter) {
      return Message::all();
      // php representation of the database of message
      // all is static methode of Messaga to retieve all the messages from the database

    }
}
