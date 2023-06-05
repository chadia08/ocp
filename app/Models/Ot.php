<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ot extends Model
{
    use HasFactory;
    protected $table="ot";

    protected $fillable = [
        'code_article',
        'num_ot',
        'description_ot',
        'ot_local',
        'description_ot_local',
        'ot_fictif',
        'description_ot_fictif',
        'type',
        'qte_sortie',
        'num_equipement',
        'statut',
        'service',
        'personne',
        'source',
        'destination',
        'date_sortie',
        'justification',
        'qte_allouee_local',
        'qte_allouee_fictif',
        'allouer',
        'taux',
        'magasinier',
    ];
}
