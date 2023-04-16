<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "date",
        "quantity",
        "rate",
        "amount",
        "supplier",
        "bill_no",
        "narration",
    ];

    public function product(){
        return $this->belongsTo("App\Models\Product");
    }

    protected $appends = ['data_product'];

    public function getDataProductAttribute(){
        $d = "";
        if($this->product != null){
            if($this->product->product_group->weight == "Yes"){
                $d .= " - " . $this->product->weight;
            }
            if($this->product->product_group->volume == "Yes"){
                $d .= " - " . $this->product->volume;
            }
            if($this->product->product_group->size == "Yes"){
                $d .= " - " . $this->product->size;
            }
            if($this->product->product_group->color == "Yes"){
                $d .= " - " . $this->product->color;
            }
            return $this->product->product_group->group_name . $d;
        }
        return null;
    }
}
