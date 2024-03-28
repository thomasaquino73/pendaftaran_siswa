<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangModel extends Model
{
    use HasFactory;
    protected $table='cabang';
    protected $guarded=[];
    // protected $fillable=['id','namacabang','kategori'];
    public $timestamps=false;
}
