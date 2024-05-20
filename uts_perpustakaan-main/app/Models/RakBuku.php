<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Rak Buku Model
class RakBuku extends Model
{
    use HasFactory;
    
    protected $table = 'rak_buku';
    protected $primaryKey = 'kd_rak';
    protected $fillable = ['lokasi'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'no_rak');
    }
}