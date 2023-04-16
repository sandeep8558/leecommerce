<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProductGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        "display",
        "category_id",
        "sub_category_id",
        "group_name",
        "brand",
        "hsn",
        "tax_name",
        "tax_percentage",
        "weight",
        "volume",
        "color",
        "size",
        "description",
        "tags",
        "title",
        "keywords",
        "description",
    ];

    public function category(){
        return $this->belongsTo("App\Models\Category");
    }

    public function sub_category(){
        return $this->belongsTo("App\Models\SubCategory");
    }

    public function products(){
        return $this->hasMany("App\Models\Product")->where('display', 'Show');
    }

    protected $appends = [
        'data_category',
        'data_sub_category',
    ];

    public function getDataCategoryAttribute(){
        return $this->category->category;
    }

    public function getDataSubCategoryAttribute(){
        return $this->sub_category->sub_category;
    }
}
