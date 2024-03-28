<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;
    protected $table='barang';
    public $timestamps=false;
    protected $guarded =[];
    protected $primaryKey = 'id';
    public $incrementing = false;
    // public function satuan(){
    //     return $this->belongsTo(SatuanModel::class,'idSatuan','idSatuan');
    // }
    // public function kategori(){
    //     return $this->belongsTo(KategoriModel::class,'idKategori','idKategori');
    // }
}
