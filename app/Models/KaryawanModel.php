<?php

namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaryawanModel extends Model
{
    use HasFactory;
    protected $table='karyawan';
    // protected $fillable=['nip','namalengkap','notel','alamat','idprovinsi','idkabupaten','avatar'];
    public $timestamps=true;
    protected $guarded =[];
    protected $primaryKey = 'id';
    public $incrementing = false;
    public function provinsi(){
        return $this->belongsTo(Provinsi::class,'idprovinsi','id');
    }
    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class,'idkabupaten','id');
    }
   
    // public $timestamps=false;

     /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('namalengkap')
            ->saveSlugsTo('slug');
    }
}
