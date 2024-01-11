<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'kode_produk', 'nama_produk', 'stok', 'harga', 'status'
    ];
    public function order(){
        return $this->belongsToMany(Order::class, 'pivot_p_o_s', 'id_produk', 'id_order');
    }
}
