<?php

namespace App\Services;

use App\Models\Game;

class GameService extends Service
{
    public function findAll($filter) {
        // return Game::all();
        return Game::where('deleted', false)->get();

        // $where = Game::where(...);
        // return $where->get();
    }
    public function findById($id){
        return Game::find($id);
    }


    public function saveNew($data) {
        $game = new Game();
        //$game->user_id = auth()->user()->id;
        $game->user_id = 1;
        $game->logo_file_path  = $data['logo'];
        $game->name = $data['name'];
        $game->link = $data['link'];
        $game->is_private = false;
        $game->databank = '';
        $game->created_at = time();
        $game->save();
    }


}
