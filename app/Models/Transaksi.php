<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_transaksi', 'id_order', 'total_harga', 'status'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }
}
