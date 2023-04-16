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
        "title",
        "keywords",
        "description",
    ];

    public function sub_categories(){
        return $this->hasMany("App\Models\SubCategory")->where('display', 'Show');
    }

    public function product_groups(){
        return $this->hasMany("App\Models\ProductGroup")->where('display', 'Show');
    }

    public function products(){
        return $this->hasMany("App\Models\Product")->where('display', 'Show');
    }
}
