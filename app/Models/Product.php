<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'img_thumbnail',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'material',
    ];

    protected  $cast = [
        'is_active',
        'is_hot_deal',
        'is_good_deal',
        'is_new',
    ];

    public function categogy(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function gallaries(){
        return $this->hasMany(ProductImage::class);
    }
    public function variants(){
        return $this->hasMany(Tag::class);
    }
}
