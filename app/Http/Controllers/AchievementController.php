<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index(){
        return view('/achievements/index',['achievements' => Achievement::where('user_id',Auth::id())->get()]);
    }
}
