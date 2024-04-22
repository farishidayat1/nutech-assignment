<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'purchase_price',
        'selling_price',
        'qty',
        'image_url',
    ];

    protected $appends = [
        'signed_image_url',
    ];

    public function getSignedImageUrlAttribute() 
    {
        return asset($this->image_url);
    }
}
