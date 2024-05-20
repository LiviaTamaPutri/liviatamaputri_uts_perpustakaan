<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Buku Model
class Buku extends Model
{
    use HasFactory;
    
    protected $table = 'buku';
    protected $primaryKey = 'no_buku';
    protected $fillable = ['judul', 'edisi', 'no_rak', 'tahun', 'penerbit', 'kd_penulis'];

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'kd_penulis');
    }

    public function rak()
    {
        return $this->belongsTo(RakBuku::class, 'no_rak');
    }
}