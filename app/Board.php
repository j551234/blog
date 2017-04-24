<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $connection = 'mysql2';
    protected $table='board';
    protected $fillable=['id','board_title','board_content'
    					,'name'
    					];

    public $timestamps = false;
   	
}
