<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'estd',
        'address',
        'zip',
        'mobile_number',
        'landline',
        'maps',
        'email',
        'about_us',
        'facebook',
        'twitter',
        'instagram',
        'linkedIn',
        'website'
    ];
}
