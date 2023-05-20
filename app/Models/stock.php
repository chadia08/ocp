<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    protected $table="stock";

    protected $fillable = [
        'code_article',
        'nom_magasin',
        'qte',
        'date_entree',
        
    ];
}
