<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'transaksis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'product_stuff_id',
        'user_id',
        'qty',
        'price',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product_stuff()
    {
        return $this->belongsTo(ProductStuff::class, 'product_stuff_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}