<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanans';
    protected $primaryKey = 'id_layanan';
    protected $fillable = [
        'kode_layanan', 'nama_layanan', 'keterangan', 'harga', 'status'
    ];
    public function order()
    {
        return $this->hasMany(Order::class, 'id_layanan');
    }
}
