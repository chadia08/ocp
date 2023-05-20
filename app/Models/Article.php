<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table="article";
    protected $fillable = [
        'id',
        'code_article',
        'descriptif',
        'description',
        'code_famille',
        'unite',
        'pmp',
        'categorie',
        'nature',
        'position',
        'criticite',
        'image',
        'barcode',
        'stock_min',
    ];
}
