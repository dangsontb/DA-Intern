<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // protected $casts = [
    //     'is_active' => 'boolean',
    // ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function product(){
        return $this->hasOne(Product::class); 
    }
}
