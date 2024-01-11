<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Layanan;
use App\Models\Produk;
use App\Models\Transaksi;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_kendaraan', 
        'nomor_mesin', 
        'nomor_polisi', 
        'seri_kendaraan', 
        'id_user',
        'nomor_telpon',
        'id_layanan',
        'tgl_booking',
        'alamat',
        'status',
    ];
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id_kendaraan');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
    public function produk(){
        return $this->belongsToMany(Produk::class, 'pivot_p_o_s', 'id_order', 'id_produk');
    }
    public function transaksi() {
        return $this->hasOne(Transaksi::class, 'id_order');
    }
}
