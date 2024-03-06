<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function index()
    {
        return view('games/index', ['games' => Game::all()]);
    }
    public function create()
    {
        return view('/games/create');
    }

    public function data(request $request)
    {   //1
        $data = $request->all();
        $data['user_id'] = Auth::id();
        
        if ($request->hasFile('logo_file_path')) {
            $imageName = time() . '.' . $request->logo_file_path->extension();
            $request->logo_file_path->move(public_path('images'), $imageName);
            $data['logo_file_path'] = "images/" . $imageName;
        }
        Game::create($data);
        return redirect()->route('games.index');
    }
    
    public function edit($id)
        $game = Game::where("id", $id)->where('user_id', auth()->id())->get()->first();
        return view('/games/edit', ['game' => $game]);

    }
    public function update(request $request, $id)
    {
        $game = game::findOrFail($id);
        $game->name = $request->input('name');
        $game->link = $request->input('link');
        $game->visibility = $request->input('visibility');

        if ($request->hasFile('logo_file_path')) {
            $imageName = time() . '.' . $request->logo_file_path->extension();
            $request->logo_file_path->move(public_path('images'), $imageName);
            $game->logo_file_path = "images/" . $imageName;
        }

        $game->save();

        return redirect()->route('games.index');
    }
    public function delete($id)
        Game::where('id', $id)->where('user_id', auth()->id())->delete();
        return redirect()->route('games.index');
    }

}

