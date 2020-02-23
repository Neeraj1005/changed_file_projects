<?php

namespace App;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
// use Spatie\MediaLibrary\HasMedia\HasMedia;
// use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
class Article extends Model 
{
    //
     // use HasMediaTrait;
    protected $table ='articles';
    protected $primaryKey ='id';
    protected $fillable = array('category_id','title','author','show_date','image','description','status','user_id','slug',
        'visit_count','aslug','subcategory_id','draft');

    // public function category(){

    //    $this->hasMny('App\Article','category_id');
    // }
   

   public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    public function user(){

        return $this->belongsTo('App\User','user_id');
    }

    public function mediaLibrary(){


        return $this->belongsTo('App\mediaLibrary','image');


    }
    
   
}
