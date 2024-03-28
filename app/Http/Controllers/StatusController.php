<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function update(request $request){
        
        if($request->model=='siswa'){
            
            $status= SiswaModel::findorfail($request->id);
            $status->setStatus($request->status);
            $status->save();
            return back();
        }
     
    }
}
