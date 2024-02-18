<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function rel_to_user(){
        return $this->belongsTo(CustomerLogin::class, 'user_id');
    }
}
