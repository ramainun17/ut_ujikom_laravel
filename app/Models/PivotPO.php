<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Order;

class PivotPO extends Model
{
    use HasFactory;
    protected $table = 'pivot_p_o_s';
    protected $fillable = [
        'id_produk', 'id_order'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }
}
