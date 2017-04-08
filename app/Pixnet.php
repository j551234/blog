<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pixnet extends Model
{
    protected $table='pixnet';
    protected $fillable=['id','search_title','search_subtitle'
    					,'search_time','search_author','article_picture','author_href'
    					,'author_picture','search_view'
    					];
   
}
