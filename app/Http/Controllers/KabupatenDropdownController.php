<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenDropdownController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $provinsi=Provinsi::findOrfail($request->id);
        $kabupatenFiltered= $provinsi->kabupaten->pluck('nama','id');
        return response()->json($kabupatenFiltered);
    }
}
