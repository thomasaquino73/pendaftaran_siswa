<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;

class Provinsi extends Model
{
    use HasFactory;
    protected $table='provinsi';
    protected $fillable=['id','nama'];
    public $timestamps=false;
    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class);
    }
}
