<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'category',
        'thumbnail',
        'content',
    ];
    
    protected $primaryKey = 'id_article';
    
}
