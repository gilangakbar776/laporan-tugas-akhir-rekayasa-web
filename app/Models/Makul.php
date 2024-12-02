<?php

// app/Models/Makul.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makul extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_matkul',
        'sks'
    ];
}