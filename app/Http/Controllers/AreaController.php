<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class AreaController extends Controller
{
    public function index(){
        return view('area.index');
    }
    
}
