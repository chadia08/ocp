<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Carbon\Carbon;
use App\Models\Ot;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SequenceGenerator;


session_start();
class OtController extends Controller
{
    public $ots;
    public $pdrs;
    public $dprf;
    public $DA;
    public $commande;
    public $progress;
    

    
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
            return redirect('/error');
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
            return redirect('/error');
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
            return redirect('/error');
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

                return redirect('/pdr');
             }catch(\Exception $e){ return redirect('/error');}
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
        if($pdrexist) return redirect('/pdr');
        else return redirect('/error');
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
        if ($request->has('checkboxes')) {
            $valeursCheckbox = $request->input('checkboxes');

            $date = Carbon::today();
            $dateFormatted = $date->format('Y-m-d');

            $newCode = SequenceGenerator::generate();

            for($i=0; $i<sizeof($valeursCheckbox); $i++){

                $dprf = DB::table('ot')
                ->where('id_ot','=',$valeursCheckbox[$i] )
                ->first();

                $sequence = '';
                if($request->input('genre')=='electrique'){
                    $sequence = 'Mé';
                }elseif($request->input('genre')=='instrument'){
                    $sequence = 'MR';
                }

                DB::table('ot')
                ->insert([
                    'num_ot' => $sequence.' '.$newCode,
                    'type'=>'dprf',
                    'code_article' => $dprf->code_article,
                    'qte_sortie' => $dprf->qte_sortie,
                    'date_sortie' => $dateFormatted,
                    'statut'=>'en attente les accords',
                ]);  
            }

            return redirect('/AttenteApprovisionnement?msg=oui');

            
        } else {
            return "Aucune case à cocher n'est sélectionnée.";
        }
    }

    public function selectdprf(Request $request){
       
        $this->dprf = DB::table('ot')
        ->join('article', 'ot.code_article', '=', 'article.code_article')
        ->join('famille','article.code_famille','=','famille.code_famille')
        ->where('type','=','dprf')
        ->get();
        return view('dprf',['dprf' => $this->dprf]);
    }

    public function passerda(Request $request){
        $date = Carbon::today();
        $dateFormatted = $date->format('Y-m-d');
        $status='';
        $challenge = $request->input('challenge');
        $budget = $request->input('budget');
        $id = $request->input('id');

    
        if ($challenge === 'oui' && $budget === 'non') {
            $status = 'En attente d\'accord budgétaire';
        } elseif ($challenge === 'non' && $budget === 'oui') {
            $status = 'En attente d\'accord challenge';
        } elseif ($challenge === 'oui' && $budget === 'oui') {
            $status = 'DA';
        }

        DB::table('ot')
            ->where('id_ot','=', $id)
            ->update(['statut' => $status]);
        
        
        if($status === 'DA') {
            $montant = $request->input('montant');
            DB::table('ot')->insert([
                'num_ot'=>$request->input('num_ot'),
                'code_article'=> $request->input('article'),
                'type' => 'DA',
                'statut' => 'En attente DA',
                'taux' => $montant,
                'qte_sortie' => $request->input('qte'),
                'date_sortie' => $dateFormatted,
                
            ]);
        }
        if($status === 'DA'){
            return redirect('/da');
        }else
        return redirect('/dprf');
}

    public function modifierqte(Request $request){
        
        echo "bonjour";
            $id = $request->input('id');
            $qte =(int) $request->input('qte');
            DB::table('ot')
            ->where('id_ot', $id)
            ->update(['qte_sortie' => $qte]);
            return redirect('/AttenteApprovisionnement?qte=oui');

    }

    public function selectDa(){
        $this->DA = DB::table('ot')
        ->join('article', 'ot.code_article', '=', 'article.code_article')
        ->join('famille','article.code_famille','=','famille.code_famille')
        ->where('type','=','DA')
        ->get();
        return view('da',['DA' => $this->DA]);
    }


    //---------------avancer da----------------//
    public function avancerDA(Request $request)
    {
        $id = (int) $request->input('id');

        // Récupérez l'enregistrement correspondant à l'ID dans la table "ot"
        $ot = DB::table('ot')->where('id_ot', $id)->first();
        
        switch ($ot->statut) {
            case "En attente DA":
                $newPhase = "AMI";
                $progress = 10;
                break;
            case "AMI":
                $newPhase = "CGA";
                $progress = 25;
                break;
            case "CGA":
                $newPhase = "En attente AO";
                $progress = 40;
                break;
            case "En attente AO":
                $newPhase = "Avis technique";
                $progress = 55;
                break;
            case "Avis technique":
                $newPhase = "En attente AC";
                $progress = 70;
                break;
            case "En attente AC":
                $newPhase = "CAD";
                $progress = 85;
                break;
            case "CAD":
                $newPhase = "CMD";
                $progress = 100;
                break;
            default:
                $newPhase = ""; 
                break;
        }
        
        $date = Carbon::today();
        $dateFormatted = $date->format('Y-m-d');

        if(DB::table('ot')->where('id_ot', $id)->update(['statut' => $newPhase,'progress'=>$progress]) == true){

            if($newPhase == 'AMI'){
                DB::table('ot')->where('id_ot', $id)->update(['statut' => $newPhase,'num_da' => $request->input('num_da'),'montant_challenge'=>$request->input('montant_challenge')]);
            }
            elseif ($newPhase == 'Avis technique'){
                DB::table('ot')->where('id_ot', $id)->update(['statut' => $newPhase,
                                                                'num_ao' => $request->input('num_ao'),
                                                                'date_ao' => $dateFormatted]);
            }  

            elseif ($newPhase == 'En attente AC'){
                DB::table('ot')->where('id_ot', $id)->update(['statut' => $newPhase,
                                                                'num_at' => $request->input('num_at'),
                                                                'date_at' => $dateFormatted]);
            } 
                
            elseif ($newPhase == 'CAD'){
                DB::table('ot')->where('id_ot', $id)->update(['statut' => $newPhase,
                                                                'num_ac' => $request->input('num_ac'),
                                                                'date_ac' => $dateFormatted]);
            }
            return redirect('/da?msg=phase_modifiée');
    }else return redirect('/da?error=phase_non_modifiée');
    }

    public function selectCmd(){
        $this->commande = DB::table('ot')
        ->join('article', 'ot.code_article', '=', 'article.code_article')
        ->join('famille','article.code_famille','=','famille.code_famille')
        ->where('statut','=','CMD')
        ->get();
        return view('commande',['commande' => $this->commande]);
    }

    public function avancerCmd(Request $request){

        $date = Carbon::today();
        $dateFormatted = $date->format('Y-m-d'); 

        $id = $request->input('id');
        $commande = DB::table('ot')
                ->where('id_ot','=',$id)
                ->first();
        
        $qte_livree = $commande->qte_livree + $request->input('qte_livree');
        $qte_initiale = $commande->qte_sortie ;
        $qte = $qte_initiale - $qte_livree;

        if($qte > 0) $stade = 'livrée partiellement';
        elseif($qte == 0) $stade = 'livrée totalement';
        else $stade = 'Non livrée';

        if($request->has('fournisseur')){
            DB::table('ot')->where('id_ot', $id)->update(['stade' => $stade,
                                                                'qte_livree' => $qte_livree,
                                                                'fournisseur' => $request->input('fournisseur')]);
        }else{
            DB::table('ot')->where('id_ot', $id)->update(['stade' => $stade,
                                                                'qte_livree' => $qte_livree]);
        }

        $commande = DB::table('ot')
                ->where('id_ot','=',$id)
                ->first();

        if($commande->stade == 'livrée totalement'){
            $stock = DB::table('stock')
                ->where('nom_magasin','=','fictif')
                ->where('code_article','=',$commande->code_article)
                ->first();

            if($stock){
                $qte_stock = $stock->qte + $commande->qte_livree;
                DB::table('stock')
                ->where('nom_magasin','=','fictif')
                ->where('code_article','=',$commande->code_article)
                ->update(['qte' => $qte_stock]);
            }else{
                DB::table('stock')
                ->insert([
                    'code_article' => $commande->code_article,
                    'nom_magasin'=>'fictif',
                    'qte' =>$commande->qte_livree,
                    'date_entree' => $dateFormatted,
                    
                ]); 
            }
            return redirect('/commande?cmd=livree_totalement');
        }elseif($commande->stade = 'livrée partiellement') return redirect('/commande?cmd=livree_partiellement');
        else return redirect('/commande');
        
    }

    public function selectbar(){
        
    $this->progress = DB::table('ot')
    ->join('article', 'ot.code_article', '=', 'article.code_article')
    ->join('famille','article.code_famille','=','famille.code_famille')
    ->where('type', '=', 'DA')
    ->get();
    
    $users = DB::table('users')->get();
    $ot = DB::table('ot')->get();
    $cmd = DB::table('ot')->where('statut','=','CMD')->get();
    
    $local= DB::table('stock')
    ->where('nom_magasin', '=', 'local')
    ->take(5)
    ->get();

    $fictif= DB::table('stock')
    ->where('nom_magasin', '=', 'fictif')
    ->take(5)
    ->get();
    
    $stockLocal = json_encode($local);
    $stockFictif = json_encode($fictif);

        return view('dashboard',['progress' => $this->progress,'users'=>$users,'ot'=>$ot,'cmd'=>$cmd,'stockLocal'=>$stockLocal,'stockFictif'=>$stockFictif]);
    }

    public function returnHome(){
        return view('home');
    }

}



