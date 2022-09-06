<?php

namespace App\Models;
use App\Models\Product;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
protected $fillable=[
    'attribute',
    'value',
    'product_id',
];

protected $casts = [
    'features' => 'json',
];

public function product(){
    return $this->belongsTo(Product::class);
}

}
