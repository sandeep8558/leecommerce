<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        "display",
        "offer_name",
        "description",
        "coupon_code",
        "start",
        "end",
        "offer_type",
        "offer_for",
        "minimum_purchase_amount",
        "maximum_offer_amount",
        "offer_value",
        "ticket_size",
        "ticket_per_day",
        "ticket_per_customer",
        "ticket_per_customer_per_day",
        "media",
    ];

    public function orders(){
        return $this->hasMany("App\Models\Order");
    }

    protected $appends = [
        'actual_ticket_size',
        'actual_ticket_per_day',
        'actual_ticket_per_customer',
        'actual_ticket_per_customer_per_day',
    ];

    public function getActualTicketSizeAttribute(){
        return $this->orders()->where('orderstatus', 'Success')->where('cancelled_at', null)->count();
    }

    public function getActualTicketPerDayAttribute(){
        $today = date('Y-m-d');
        return $this->orders()->where('orderstatus', 'Success')->where('cancelled_at', null)->whereDate('created_at', $today)->count();
    }

    public function getActualTicketPerCustomerAttribute(){
        if(Auth::check()){
            $user_id = Auth::id();
            return $this->orders()->where('user_id', $user_id)->where('orderstatus', 'Success')->where('cancelled_at', null)->count();
        }
        return 0;
    }

    public function getActualTicketPerCustomerPerDayAttribute(){
        if(Auth::check()){
            $today = date('Y-m-d');
            $user_id = Auth::id();
            return $this->orders()->where('user_id', $user_id)->where('orderstatus', 'Success')->where('cancelled_at', null)->whereDate('created_at', $today)->count();
        }
        return 0;
    }
}
