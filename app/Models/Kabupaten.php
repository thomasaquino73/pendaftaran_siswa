<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table='kabupaten';
    protected $fillable=['id','nama','provinsi_id'];
    public $timestamps=false;
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
   
}
