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
        //dump($data);
        //$data['1','2','3'];
        //dat wordt niet mee gestuurd met de form
        // id van de ingelogde user 
        // user_id is gelijk aan de ingelogde user want die heeft de game gemaakt
        //2
        $data['user_id'] = Auth::id();
        

        if ($request->hasFile('logo_file_path')) {
            //fotos kunnen met zelfde naam zijn en als je geen time gebruikt dan kan dat niet overwriten qua naam 
            $imageName = time() . '.' . $request->logo_file_path->extension();
            // fotos moeten in een file worden opgeslagen 
            $request->logo_file_path->move(public_path('images'), $imageName);
            //array
            $data['logo_file_path'] = "images/" . $imageName;
        }
        // alles da in data steekt wordt gestuurd naar de database
        //3

        //1 dat stuurt al de gegevens van form naar de database
        //2 deze geeft user_id aan de games zodat je weet welke user de game heeft gemaakt
        Game::create($data);

        
        //stuurt naar een andere pagina 
        return redirect()->route('games.index');
    }
    public function edit($id)
    { // we halen eerst de id van de game, dat alleen de user die de game heeft gemaakt het kan editen
        $game = Game::where("id", $id)->where('user_id', auth()->id())->get()->first();
        return view('/games/edit', ['game' => $game]);

    }
    public function update(request $request, $id)
    {
        //zoekt of er een id is of niet
        $game = game::findOrFail($id);
        //->('link') betekent de naam van de form 
        //input zijn de gegevens van de form 
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
    {   //alles van dubbelpunt na een model komt van de model
        Game::where('id', $id)->where('user_id', auth()->id())->delete();
        // Game::where('id', $id)->delete();
        return redirect()->route('games.index');
    }

}

