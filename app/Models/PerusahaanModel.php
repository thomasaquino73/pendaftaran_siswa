<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerusahaanModel extends Model
{
    use HasFactory;
    protected $table='perusahaan';
    protected $fillable=['namaperusahaan','alamat','notel','email','logo'];
    public $timestamps=false;
}
