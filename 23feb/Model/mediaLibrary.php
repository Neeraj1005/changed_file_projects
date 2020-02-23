<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mediaLibrary extends Model
{
    protected $fillable = ['filename','mime','extension','original_filename','imgsize','width','height'];
    
}
