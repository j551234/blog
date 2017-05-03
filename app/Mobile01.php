<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobile01 extends Model
{
    protected $table='mobile01';
    protected $fillable=['id','search_title','key-word','search_href'
    					,'search_time','search_author','article_picture','author_href'
    					,'search_view','score_people','total_score'
    					];

    public $timestamps = false;
   	
}
