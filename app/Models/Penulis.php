<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Penulis Model
class Penulis extends Model
{
    use HasFactory;
    
    protected $table = 'penulis';
    protected $primaryKey = 'kd_penulis';
    protected $fillable = ['nama_penulis', 'tempat_lahir', 'tgl_lahir', 'email'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kd_penulis');
    }
}