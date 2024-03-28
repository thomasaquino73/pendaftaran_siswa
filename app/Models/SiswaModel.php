<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class SiswaModel extends Model
{
    use HasFactory;
    use HasStatuses;
    
    protected $table='siswa';
    protected $guarded = [];
    protected $fillable=['id','full_name','reg_number','family_name','code','place_birth','date_birth','nationality','address','idprovinsi','idkabupaten','foto'];
    public $timestamps=false;
    public function provinsi(){
        return $this->belongsTo(Provinsi::class,'idprovinsi','id');
    }
    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class,'idkabupaten','id');
    }
    
}
