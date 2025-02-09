<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = [
        'idkategori', 'nomorseri', 'judul', 'penerbit', 
        'pengarang', 'tahun', 'status', 'kondisi', 'rak', 'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }
}
