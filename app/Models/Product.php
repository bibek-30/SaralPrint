<?php

namespace App\Models;

use App\Models\RateList;
use App\Models\Attribute;
use App\Models\CorporateRateList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'image',
        'desc',
        'category_id',
        'size',
        'paperWeight',
        'lamination',
        'weight',
        'discount'
    ];

    //Primary Key

    public $primaryKey = 'id';

    //Timestamps

    public $timestamps =true;

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function attribute(){
        return $this ->hasMany(Attribute::class);
    }

    public function rateList(){
        return $this ->hasMany(RateList::class);
    }
    public function corporateRateList(){
        return $this ->hasMany(CorporateRateList::class);
    }
}

