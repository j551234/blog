<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $connection = 'mysql2';
    protected $table='mail';
    protected $fillable=['id','problem','contact_name'
    					,'contact_mail','contact_number','contact_message'
    					];

    public $timestamps = false;
   	
}
