<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use Illuminate\Support\Carbon;
use App\Models\PerusahaanModel;

class PerusahaanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
        $this->middleware('permission:company-list', ['only' => ['index','show']]);
        $this->middleware('permission:company-create', ['only' => ['create','store']]);
        $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:company-delete', ['only' => ['destroy']]);
        $this->middleware('permission:company-view', ['only' => ['show']]);
   }
    public function index()
    {
        $dataperusahaan=PerusahaanModel::first();
        $datakaryawan=KaryawanModel::paginate(18);
        return view('perusahaan.index',compact(['dataperusahaan','datakaryawan']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataperusahaan=PerusahaanModel::where('id',$id)->first();

        return view('perusahaan.edit',compact(['dataperusahaan']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $name=$request->namalengkap;
        $name=uniqid();
        $destinasi=('assets/uploads/logo');
        $image=$request->file('logo');
        if($request->file('logo')){
            $input = $request->all();
            $input['logo'] = $image->move($destinasi,$name.time().'.'.$image->getClientOriginalExtension());
        }else{
            $input = $request->all();
        }
        $perusahaan = PerusahaanModel::find($id);
        $perusahaan->update($input);
        $data=[
            'date'=>new Carbon(),
            'action'=>'Update',
            'user'=>'1',
            'note'=>'Update Perusahaan',
        ];
        HistoryModel::create($data);
        $notifikasi = array(
            'pesan' => 'Data Berhasil Diubah',
            'alert' => 'success',
        );
        return redirect()->route('perusahaan.index')->with($notifikasi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
