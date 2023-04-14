<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "mobile",
        "email",
        "name",
        "address",
        "city",
        "pincode",
        "state",
        "country",
        "default",
        "deleted",
        "lat",
        "lng",
    ];

    public function user(){
        return $this->belongsTo("App\Models\User");
    }
}
