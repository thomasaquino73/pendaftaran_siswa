<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;
    protected $table='parent';
    protected $guarded = [];
    protected $fillable=['full_name_parent','family_name_parent','relation','email','mobile_no','office_no','code','reg_number'];
    public $timestamps=false;
}
