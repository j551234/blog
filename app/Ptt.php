<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ptt extends Model
{
    protected $table='ptt';
    protected $fillable=['id','key_word','search_title'
    					,'search_href','search_board','search_author','push_count'
    					,'boo_count','arrow_count','search_time'
    					];

    public $timestamps = false;
   	
}
