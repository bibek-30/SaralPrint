<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // protected $table = 'mastercategory';
    protected $fillable = [
        'name',
        'parent_id'
    ];


    public function parent($query){
        $query-> whereNull('parent_id');
    }

    public function subCategories(){
        return $this ->hasMany(Category::class,'parent_id',null);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
