<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //protected $table = 'posts';
 //$softDelete = true;
 public $softDelete=true;
    //protected $dates = ['deleted_at'];
    protected $guarded =['id'];
    //protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function hasTag($tagId){
        return in_array($tagId,$this->pluck('id')->toArray());
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
