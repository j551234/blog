<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $connection = 'mysql2';
    protected $table='feedback';
    protected $fillable=['id','problem','contact_name'
    					,'contact_mail','contact_number','contact_message'
    					];

    public $timestamps = false;
   	
}
