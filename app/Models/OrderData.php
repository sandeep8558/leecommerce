<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class OrderData extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id", "product_id", "group_name", "brand", "hsn",
        "tax_name", "tax_percentage", "itemcode", "barcode", "weight",
        "volume", "color", "size", "mrp", "cost",
        "tax", "rate", "qty", "mrp_total", "cost_total",
        "tax_total", "rate_total", "replace_at", "replaced_at", "cancelled_at"
    ];

    public function order(){
        return $this->belongsTo("App\Models\Order");
    }

    public function product(){
        return $this->belongsTo("App\Models\Product");
    }

    protected $appends = [
        'purchase_amount'
    ];

    public function getPurchaseAmountAttribute(){
        $p = Purchase::where('product_id', $this->product_id);
        $count = $p->count();
        $sum = $p->sum('rate');
        return $this->qty * ($sum / $count);
    }
}
