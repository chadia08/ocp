<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public $article;
    public $user;
    
    public function __construct(){
            
        $this->article = DB::table('article')->get();
        $this->user = DB::table('users')->get();
    }

    public function index(){
        return view('articles',['article' => $this->article]);
    }

    public function users(){
        return view('blank',['user' => $this->user]);
    }

    public function details(Request $request){
        $id=(int)$request->id;
        return view('details',['article'=>$this->article,'id'=>$id]);
    }

    // public function form(Request $request){
    //     return view('welcome');

    // }

    // public function validation(Request $request){
    //     $user = new User();
    //     $user->nom= $request->nom;
    //     $user->prenom = $request->prenom;
    //     $user->matricule = $request->matricule;
    //     $user->password = $request->password; 
    //     $user->save();
    // }
}
