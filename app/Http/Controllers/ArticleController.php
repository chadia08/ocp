<?php

namespace App\Http\Controllers;
use App\Models\Equipement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Actions\Jetstream\DeleteUser;
use Laravel\Jetstream\Contracts\DeletesTeams;
use App\Models\Team;
use Laravel\Jetstream\Jetstream;
use Jetstream\Actions\DeleteTeam;


class ArticleController extends Controller
{
    public $article;
    public $results;
    public $results2;
    public $equipement;
    
    
    public function __construct(){
            
        $this->article = DB::table('article')->get();
        
    }

    public function stock(){
        return view('stock',['article' => $this->article]);
    }

    public function barcode(){
        return view('barcode',['article' => $this->article]);
    }
    
    public function stocklocal(Request $request){
        $this->results = DB::table('article')
        ->join('stock', 'stock.code_article', '=', 'article.code_article')
        ->join('famille', 'article.code_famille', '=', 'famille.code_famille')
        ->join('ot', 'ot.code_article', '=', 'article.code_article')
        ->select('stock.*', 'article.*', 'famille.*','ot.*')
        ->where('stock.nom_magasin', '=', 'local')
        ->where('ot.type','=','local')
        ->get();
        return view('stockLocal',['results'=>$this->results]);
    }

    public function stockfictif(Request $request){
        $this->equipement = DB::table('equipement')->get();
        $this->results2 = DB::table('article')
        ->join('stock', 'stock.code_article', '=', 'article.code_article')
        ->join('famille', 'article.code_famille', '=', 'famille.code_famille')
        ->select('stock.*', 'article.*', 'famille.*')
        ->where('stock.nom_magasin', '=', 'fictif')
        ->get();
        return view('stockFictif',['results'=>$this->results2,'equipement'=>$this->equipement]);
    }

    

    public function details(Request $request){
        $id=(int)$request->id;
        return view('details',['article'=>$this->article,'id'=>$id]);
    }



    
}
