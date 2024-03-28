<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class KursusModel extends Model
{
    use HasFactory;
    use HasSlug;
    use HasStatuses;

    protected $table='kursus';
    protected $guarded=[];
    // public $timestamps=false;

     /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('reg_number')
            ->saveSlugsTo('slug');
    }
}
