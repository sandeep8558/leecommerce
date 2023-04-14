<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "address_id",
        "mrp_total",
        "cost_total",
        "tax_total",
        "rate_total",
        "discount",
        "offer_discount",
        "delivery",
        "payable",
        "accepted_at",
        "picked_at",
        "packed_at",
        "shipped_at",
        "delivered_at",
        "accepted_by",
        "picked_by",
        "packed_by",
        "shipped_by",
        "delivered_by",
        "r_accepted_at",
        "r_picked_at",
        "r_packed_at",
        "r_shipped_at",
        "r_delivered_at",
        "r_accepted_by",
        "r_picked_by",
        "r_packed_by",
        "r_shipped_by",
        "r_delivered_by",
        "replace_at",
        "cancelled_at",
        "payment_at",
        "razorpay_payment_id",
        "orderstatus",
        "paymentmode"
    ];

    public function user(){
        return $this->belongsTo("App\Models\User");
    }

    public function address(){
        return $this->belongsTo("App\Models\Address");
    }

    public function acceptor(){
        return $this->belongsTo("App\Models\User", "accepted_by");
    }

    public function picker(){
        return $this->belongsTo("App\Models\User", "picked_by");
    }

    public function packer(){
        return $this->belongsTo("App\Models\User", "packed_by");
    }

    public function shipper(){
        return $this->belongsTo("App\Models\User", "shipped_by");
    }

    public function deliverer(){
        return $this->belongsTo("App\Models\User", "delivered_by");
    }

    public function re_acceptor(){
        return $this->belongsTo("App\Models\User", "r_accepted_by");
    }

    public function re_picker(){
        return $this->belongsTo("App\Models\User", "r_picked_by");
    }

    public function re_packer(){
        return $this->belongsTo("App\Models\User", "r_packed_by");
    }

    public function re_shipper(){
        return $this->belongsTo("App\Models\User", "r_shipped_by");
    }

    public function re_deliverer(){
        return $this->belongsTo("App\Models\User", "delivered_by");
    }

    public function order_data(){
        return $this->hasMany("App\Models\OrderData");
    }
}
