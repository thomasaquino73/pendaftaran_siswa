<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryModel extends Model
{
    use HasFactory;
    protected $table='history';
    protected $fillable=['id','date','action','user','note'];
    public $timestamps=false;
}
