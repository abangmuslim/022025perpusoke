<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Peminjam extends Authenticatable
{
    use HasFactory;

    protected $table = 'peminjam';

    protected $fillable = [
        'namapeminjam',
        'username',
        'password',
        'status',
        'setujui',
    ];

    protected $hidden = [
        'password',
    ];
}
