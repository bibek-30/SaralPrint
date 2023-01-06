<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    use HasFactory;
   protected $fillable=[
    'name',
    'gender',
    'email',
    'password',
    // 'city',
    'address',
    'mobile_number',
    // 'telephone  ',
    'type',
    'pan_number',
    'status',
    'pan_document',
    'profile_image',
    'mobile_verified_code',
    'is_admin',
];
}
