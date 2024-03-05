## de foreach in de blade komt van wat je mee returnd in the view 











  public function index(){
        return view('/friends/index',['users'=>User::all(),'Friends'=>Friend::where('user_sender_id',Auth::id())->get(),'games'=>Game::all()]);
    }

## 'Friends' dit haalt data op vanuit friend model zodat je dat mee kan geven in de view/blade  en zo kan je bv een foreach gebruiken om aan de gegevens te komen die in die model zijn 