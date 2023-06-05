<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Carbon\Carbon;
use App\Models\Ot;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtController extends Controller
{
    public $ots;
    public $pdrs;

    public function insertOt(Request $request){

    // Validez les données du formulaire
    $request->validate([
        'ot' => 'required',
        'description' => 'required',
        'qte' => 'required|numeric',
        'position' => 'required',
        'equipement' => 'required',
        'statut' => 'required',
    ]);

    $date = Carbon::today();
    $dateFormatted = $date->format('Y-m-d');

    $ot = Ot::create([
        'code_article' => $request->input('article'),
        'num_ot' => $request->input('ot'),
        'description_ot' => $request->input('description'),
        'qte_sortie' => (int)$request->input('qte'),
        'num_equipement' => $request->input('equipement'),
        'statut' => $request->input('statut'),
        'source'=>'K0431',
        'destination'=>'LOCAL MEA',
        'type'=>'local',
        'date_sortie'=>$dateFormatted,
    ]);

   

    // Mettez à jour la quantité de stock dans la table stock
    if($ot){

        $stockLocal = DB::table('stock')->where('code_article', '=', $request->input('article'))->where('nom_magasin','=','local')->first();
        $stockFictif = DB::table('stock')->where('code_article', '=', $request->input('article'))->where('nom_magasin','=','fictif')->first();
        
        
        if ($stockLocal) {
            $newQteL = $stockLocal->qte + $request->input('qte');
            DB::table('stock')->where('code_article', '=',$request->input('article'))->where('nom_magasin','=','local')->update(['qte' => $newQteL]);
            
            $newQteF = $stockFictif->qte - $request->input('qte');
            DB::table('stock')->where('code_article', '=',$request->input('article'))->where('nom_magasin','=','fictif')->update(['qte' => $newQteF]);
        } else {
            DB::table('stock')->insert(['code_article' => $request->input('article'),'nom_magasin'=>'local', 'qte' =>$request->input('qte'),'date_entree'=>$dateFormatted ]);
            
            $newQteF = $stockFictif->qte - $request->input('qte');
            DB::table('stock')->where('code_article', '=',$request->input('article'))->where('nom_magasin','=','fictif')->update(['qte' => $newQteF]);

        }
    return redirect('/ot');};
        
    }

    public function selectOt(){
        $this->ots = DB::table('ot')
        ->join('article','ot.code_article','=', 'article.code_article')
        ->where('type','=','local')
        ->select('ot.*', 'article.*')
        ->get();
        return view('ot',['ots' => $this->ots]);
    }

    
    public function HorsZone(Request $request){
        $request->validate([
            'ot' => 'required',
            'description' => 'required',
            'qte' => 'required|numeric',
            'demandeur' => 'required',
            'service' => 'required',
            'DestinationHorsZone'=>'required',
        ]);
        
        $date = Carbon::today();
        $dateFormatted = $date->format('Y-m-d');

        $cession = Ot::create([
            'code_article' => $request->input('article'),
            'num_ot' => $request->input('ot'),
            'description' => $request->input('description'),
            'type'=>'cession hors zone',
            'qte_sortie' => (int)$request->input('qte'),
            'personne' => $request->input('demandeur'),
            'service' => $request->input('service'),
            'source'=>'K0431',
            'destination'=>$request->input('DestinationHorsZone'),
            'date_sortie'=>$dateFormatted,
        ]);

        if($cession){
            $stockFictif = DB::table('stock')->where('code_article', '=', $request->input('article'))->where('nom_magasin','=','fictif')->first();
            $newQteF = $stockFictif->qte - $request->input('qte');
            DB::table('stock')->where('code_article', '=',$request->input('article'))->where('nom_magasin','=','fictif')->update(['qte' => $newQteF]);
            return redirect('/cessions');
        }else{
            return redirect('/error')->with('error_message', 'Impossible de créer une cession.');
        }
    
    }

    public function insertcessloc(Request $request){
        $request->validate([
            'ot' => 'required',
            'description' => 'required',
            'qte' => 'required|numeric',
            'demandeur' => 'required',
            'service' => 'required',
            'DestinationZoneLocal'=>'required',
        ]);
        
        $date = Carbon::today();
        $dateFormatted = $date->format('Y-m-d');

        $cessionL = Ot::create([
            'code_article' => $request->input('article'),
            'num_ot' => $request->input('ot'),
            'description_ot' => $request->input('description'),
            'type'=>'cession local',
            'qte_sortie' => (int)$request->input('qte'),
            'personne' => $request->input('demandeur'),
            'service' => $request->input('service'),
            'source'=>'Local MEA',
            'destination'=>$request->input('DestinationZoneLocal'),
            'date_sortie'=>$dateFormatted,
        ]);

        if($cessionL){
            $stockLocal = DB::table('stock')->where('code_article', '=', $request->input('article'))->where('nom_magasin','=','local')->first();
            $newQteL = $stockLocal->qte - $request->input('qte');
            DB::table('stock')->where('code_article', '=',$request->input('article'))->where('nom_magasin','=','local')->update(['qte' => $newQteL]);
            return redirect('/cessions');
        }else{
            return redirect('/error')->with('error_message', 'Impossible de créer une cession.');
        }
    
    }

    
    public function ficcessloc(Request $request){
        $request->validate([
            'ot' => 'required',
            'description' => 'required',
            'qte' => 'required|numeric',
            'demandeur' => 'required',
            'service' => 'required',
            'DestinationZoneLocal'=>'required',
        ]);
        
        $date = Carbon::today();
        $dateFormatted = $date->format('Y-m-d');

        $cessionL = Ot::create([
            'code_article' => $request->input('article'),
            'num_ot' => $request->input('ot'),
            'description_ot' => $request->input('description'),
            'type'=>'cession local',
            'qte_sortie' => (int)$request->input('qte'),
            'personne' => $request->input('demandeur'),
            'service' => $request->input('service'),
            'source'=>'K0431',
            'destination'=>$request->input('DestinationZoneLocal'),
            'date_sortie'=>$dateFormatted,
        ]);

        if($cessionL){
            $stockLocal = DB::table('stock')
                            ->where('code_article', '=', $request->input('article'))
                            ->where('nom_magasin','=','fictif')->first();

            $newQteL = $stockLocal->qte - $request->input('qte');
            DB::table('stock')->where('code_article', '=',$request->input('article'))->where('nom_magasin','=','fictif')->update(['qte' => $newQteL]);
            return redirect('/cessions');
        }else{
            return redirect('/error')->with('error_message', 'Impossible de créer une cession.');
        }
    }
    public function selectcessions(){
        $this->ots = DB::table('ot')
                ->join('article', 'ot.code_article', '=', 'article.code_article')
                ->where(function ($query) {
                    $query->where('type', '=', 'cession hors zone')
                          ->orWhere('type', '=', 'cession local');
                })
                ->get();

        return view('cessions',['ots' => $this->ots]);
    }

    public function creerArticle(Request $request){
        // From PDR
        $request->validate([
            'article' => 'required',
            'descriptif'=>'required',
            'description' => 'required',
            'famille'=>'required',
            'nature'=>'required',
            'categorie'=>'required',
            'qte' => 'required|numeric',
            'stock_min'=>'required',
            'personne' => 'required',
            'prix'=>'required',
            'service'=>'required',
            'installation'=>'required',
            'justification'=>'required',
            'statut'=>'required',
            'criticite'=>'required',
        ]);

        $date = Carbon::today();
        $dateFormatted = $date->format('Y-m-d');

        $newArticle = Article::create([
            'code_article' => $request->input('article'),
            'descriptif' => $request->input('descriptif'),
            'description' => $request->input('description'),
            'code_famille'=>$request->input('famille'),
            'nature'=>$request->input('nature'),
            'categorie'=>$request->input('categorie'),
            'unite'=>$request->input('unite'),
            'pmp' => (float)$request->input('prix'),
            'stock_min'=>(int)$request->input('stock_min'),
            'criticite'=>$request->input('criticite'),
        ]);

        if($newArticle){
            try{
                $otNewpdr = Ot::create([
                    'code_article' => $request->input('article'),
                    'type'=>'pdr',
                    'qte_sortie' => (int)$request->input('qte'),
                    'personne' => $request->input('personne'),
                    'service'=> $request->input('service'),
                    'num_equipement'=> $request->input('installation'),
                    'justification'=> $request->input('justification'),
                    'statut'=> $request->input('statut'),
                    'qte_allouee_local'=>0,
                    'qte_allouee_fictif'=>0,
                    'allouer'=>'non',
                    'date_sortie'=>$dateFormatted,
                    'destination'=>'En attente approvisionnement',
                    'taux'=>0,
                ]);

                redirect('/pdr');
             }catch(\Exception $e){ redirect('/error');}
        }
    }

    public function ExistArticle(Request $request){
        $destination='';
    try{ $request->validate([
            'article' => 'required',
            'quantite' => 'required|numeric',
            'personne' => 'required',
            'service'=>'required',
            'installation'=>'required',
            'justification'=>'required',
            'statut'=>'required',
            'criticite'=>'required',
        ]);

        $date = Carbon::today();
        $dateFormatted = $date->format('Y-m-d');

        $article = DB::table('article')->where('code_article','=',$request->input('article'))->first();
        $stockLocal = DB::table('stock')->where('nom_magasin','=','local')->where('code_article','=',$request->input('article'))->first();
        $stockFictif = DB::table('stock')->where('nom_magasin','=','fictif')->where('code_article','=',$request->input('article'))->first();
        $quatiteRestante = $stockLocal->qte -(int)$request->input('quantite');
        $qteAlloueeLocal=$stockLocal->qte-$article->stock_min;
        $qteAlloueeFictif=(int)$request->input('quantite')-$qteAlloueeLocal;

        $qte_demande = (int)$request->input('quantite');
        $satisfaction = (100*($qteAlloueeLocal+$qteAlloueeFictif))/$qte_demande;
        $taux = number_format($satisfaction,2);
                            
        
        if($taux == 100){
            $destination = 'en attente distribution';
            }elseif (0<$taux && $taux<=99.99)  {
                $destination = 'en attente distribution / en attente approvisionnement';
                }else{
                    $destination = 'en attente approvisionnement';
                }
        

        if($quatiteRestante >= $article->stock_min){
            $pdrexist = Ot::create([
                'code_article' => $request->input('article'),
                'justification' => $request->input('justification'),
                'qte_sortie' => (int)$request->input('quantite'),
                'num_equipement' => $request->input('installation'),
                'statut' => $request->input('statut'),
                'service'=>$request->input('service'),
                'personne'=>$request->input('personne'),
                'type'=>'pdr',
                'date_sortie'=>$dateFormatted,
                'qte_allouee_local'=>(int)$request->input('quantite'),
                'qte_allouee_fictif'=> 0,
                'allouer'=>'non',
                'destination'=>$destination,
                'taux'=>$taux,
            ]);

        }else{
            $pdrexist = Ot::create([
                'code_article' => $request->input('article'),
                'justification' => $request->input('justification'),
                'qte_sortie' => (int)$request->input('quantite'),
                'num_equipement' => $request->input('installation'),
                'statut' => $request->input('statut'),
                'service'=>$request->input('service'),
                'personne'=>$request->input('personne'),
                'type'=>'pdr',
                'date_sortie'=>$dateFormatted,
                'qte_allouee_local'=>$qteAlloueeLocal,
                'qte_allouee_fictif'=> (int)$request->input('quantite')-$qteAlloueeLocal,
                'allouer'=>'oui',
                'destination'=>$destination,
                'taux'=>$taux,
            ]);
        }

        

        
    } catch (\Exception $e) {
        // Affichage de l'erreur
        dd($e->getMessage());
    }
        if($pdrexist) redirect('/pdr');
        else redirect('error');
    }

    public function otlocal(Request $request){
        try {
            $request->validate([
            'article' => 'required',
            'ot_local'=>'required',
            'description_ot_local'=>'required',
            'magasinier'=>'required',
            'id'=>'required',
        ]);
        DB::table('ot')
            ->where('id_ot', '=', $request->input('id'))
            ->update([
                'ot_local' => $request->input('ot_local'),
                'description_ot_local' => $request->input('description_ot_local'),
                'magasinier' => $request->input('magasinier')
            ]);
        
        $stockLocal = DB::table('stock')
            ->where('nom_magasin','=','local')
            ->where('code_article','=',$request->input('article'))
            ->first();

        $newQteL = $stockLocal->qte - $request->input('qte_allouee_local');
        DB::table('stock')->where('code_article', '=',$request->input('article'))
                          ->where('nom_magasin','=','local')->update(['qte' => $newQteL]);

        
        return redirect('/consommation');

            

    }catch(\Exception $v){
        dd($v->getMessage());
    }
    }

    public function otfictif(Request $request){
        try {
            $request->validate([
            'article' => 'required',
            'ot_local'=>'required',
            'description_ot_local'=>'required',
            'magasinier'=>'required',
            'id'=>'required',
        ]);
        DB::table('ot')
            ->where('id_ot', '=', $request->input('id'))
            ->update([
                'ot_fictif' => $request->input('ot_fictif'),
                'description_ot_fictif' => $request->input('description_ot_fictif'),
                'magasinier' => $request->input('magasinier')
            ]);
        
        $stockFictif = DB::table('stock')
            ->where('nom_magasin','=','fictif')
            ->where('code_article','=',$request->input('article'))
            ->first();
            
        $newQteF = $stockFictif->qte - $request->input('qte_allouee_local');
        DB::table('stock')->where('code_article', '=',$request->input('article'))
                          ->where('nom_magasin','=','fictif')->update(['qte' => $newQteF]);

        return redirect('/consommation');

            

    }catch(\Exception $v){
        dd($v->getMessage());
    }

    }

    public function otlocalfictif(Request $request){
        try {
            $request->validate([
            
            'ot_local'=>'required',
            'article'=>'required',
            'description_ot_local'=>'required',
            'ot_fictif'=>'required',
            'description_ot_fictif'=>'required',
            'magasinier'=>'required',
            'id'=>'required',
        ]);
        DB::table('ot')
            ->where('id_ot', '=', $request->input('id'))
            ->update([
                'ot_local' => $request->input('ot_local'),
                'description_ot_local' => $request->input('description_ot_local'),
                'ot_fictif' => $request->input('ot_fictif'),
                'description_ot_fictif' => $request->input('description_ot_fictif'),
                'magasinier' => $request->input('magasinier')
            ]);

        $stockLocal = DB::table('stock')
                        ->where('nom_magasin','=','local')
                        ->where('code_article','=',$request->input('article'))
                        ->first();

        $stockFictif = DB::table('stock')
                        ->where('nom_magasin','=','fictif')
                        ->where('code_article','=',$request->input('article'))
                        ->first();

        $newQteL = $stockLocal->qte - $request->input('qte_allouee_local');
        $newQteF = $stockFictif->qte - $request->input('qte_allouee_fictif');

        DB::table('stock')->where('code_article', '=',$request->input('article'))
                          ->where('nom_magasin','=','local')->update(['qte' => $newQteL]);

        DB::table('stock')->where('code_article', '=',$request->input('article'))
                          ->where('nom_magasin','=','fictif')->update(['qte' => $newQteF]);                 
            

        return redirect('/consommation');

        }catch(\Exception $v){
            dd($v->getMessage());
        }
    }

    public function selectPdr(){
        $this->pdrs = DB::table('ot')
        ->join('article', 'ot.code_article', '=', 'article.code_article')
        ->where('type','=','pdr')
        ->get();

        return view('pdr',['pdrs' => $this->pdrs]);
    }
    public function selectCons(){
        $this->pdrs = DB::table('ot')
        ->join('article', 'ot.code_article', '=', 'article.code_article')
        ->where('type','=','pdr')
        ->where('destination','=','en attente distribution')
        ->get();

        return view('consommation',['pdrs' => $this->pdrs]);
    }

    public function SelectAtt(){
        $this->pdrs = DB::table('ot')
        ->join('article', 'ot.code_article', '=', 'article.code_article')
        ->join('famille','article.code_famille','=','famille.code_famille')
        ->where('type','=','pdr')
        ->where('destination','=','en attente approvisionnement')
        ->get();

        return view('attenteApprovisionnement',['pdrs' => $this->pdrs]);
    }

    public function SubmitDprf(Request $request){
        $famille  = $request->input('famille');

        $this->pdrs = DB::table('ot')
        ->join('article', 'ot.code_article', '=', 'article.code_article')
        ->join('famille','article.code_famille','=','famille.code_famille')
        ->where('type','=','pdr')
        ->where('destination','=','en attente approvisionnement')
        ->where('article.code_famille','=',$famille)
        ->get();
        return view('attenteApprovisionnement',['pdrs' => $this->pdrs]);
    }

    public function PasserDprf(Request $request){
        echo $request->input('dprf');
    }
}
