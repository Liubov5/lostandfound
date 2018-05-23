<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
	
    protected $fillable = ["title","description","status","done","contact","image","created_at","updated_at"];
     public $timestamps = true;
}
