<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = ['namakategori'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'idkategori');
    }
}
