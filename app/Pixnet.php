<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pixnet extends Model
{
    protected $table='pixnet';
    protected $fillable=['title','link','S_title',
    					'date','article_pic','id',
    					];
   
}
