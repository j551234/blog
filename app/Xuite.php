<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xuite extends Model
{
    protected $table='xuite';
    protected $fillable=['id','search_title','search_subtitle'
    					,'search_time','search_author','article_picture','author_href'
    					,'author_picture','search_view'
    					];

    public $timestamps = false;
   	
}
