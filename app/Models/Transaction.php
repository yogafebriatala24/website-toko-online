<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'users_id',
        'inscurance_price',
        'shipping_price',
        'transaction_status',
        'total_price',
        'code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];

    public function user(){
        return $this->belongsTo(User::class,'users_id', 'id');
    }

}
