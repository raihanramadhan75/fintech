<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah',
        'invoice_id'
    ];
    public function barang (){
        return $this->belongsTo(Barang::class);
    }

    public function user (){
        return $this->belongsTo(User::class);
    }
}
