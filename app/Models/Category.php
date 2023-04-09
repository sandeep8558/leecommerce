<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "display",
        "category",
        "media",
    ];

    public function sub_categories(){
        $this->hasMany("App\Models\SubCategory");
    }

    public function product_groups(){
        $this->hasMany("App\Models\ProductGroup");
    }

    public function products(){
        $this->hasMany("App\Models\Product");
    }
}
