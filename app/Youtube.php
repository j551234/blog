<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    protected $table='youtube';
    protected $fillable=['id','key_word','search_title'
    					,'search_href','search_author','push_count'
    					,'boo_count','arrow_count','search_time','author_href','article_picture'
    					];
    public $timestamps = false;
   	
}
