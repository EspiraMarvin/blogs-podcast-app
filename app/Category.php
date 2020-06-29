<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //table name
    protected $table = 'categories';
    //primary key
    public $primaryKey = 'id';
    //time stamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(Post::class);
    }

    public function posts()
    {
        return $this->hasMany(Post ::class);
    }
}
