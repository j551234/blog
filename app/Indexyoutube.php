<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indexyoutube extends Model
{
    protected $table='indexyoutube';
    protected $fillable=['id','search_title'
    					,'search_author','article_picture','search_href'
    					,'author_picture','web_view','score_people','total_score'
    					];

    public $timestamps = false;
   	
}
