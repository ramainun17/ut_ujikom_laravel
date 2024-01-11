<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraans';
    protected $primaryKey = 'id_kendaraan';
    protected $fillable = [
        'tipe_kendaraan', 'status'
    ];
    public function order()
    {
        return $this->hasMany(Order::class, 'id_kendaraan');
    }
}
