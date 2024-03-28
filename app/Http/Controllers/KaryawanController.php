<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:teacher-list|teacher-create|teacher-edit|teacher-delete', ['only' => ['index','show']]);
        $this->middleware('permission:teacher-list', ['only' => ['index','show']]);
        $this->middleware('permission:teacher-create', ['only' => ['create','store']]);
        $this->middleware('permission:teacher-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:teacher-delete', ['only' => ['destroy']]);
        $this->middleware('permission:teacher-view', ['only' => ['show']]);
   }
    public function index(Request $request)
    {
       
        $datacreate=[
                    'provinsi'=>Provinsi::orderBy('nama','asc')
                    ->get(),
                    'kabupaten'=>Kabupaten::orderBy('nama','asc')
                    ->get(),
                    'data'=>KaryawanModel::select('*','karyawan.id as karyawanid','provinsi.nama as namaprovinsi','kabupaten.nama as namakabupaten')
                    ->join('provinsi', 'provinsi.id', '=', 'karyawan.idprovinsi','left')
                    ->join('kabupaten', 'kabupaten.id', '=', 'karyawan.idkabupaten','left')->paginate(12),
                ];
        
        return view('karyawan.index')->with($datacreate);
    }

    
    public function create()
    {


    }
    public function __invoke(Request $request)
    {
        $provinsi=KaryawanModel::findOrfail($request->id);
        $kabupatenFiltered= $provinsi->kabupaten->pluck('nama','id');
        return response()->json($provinsi);
    }
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nip' => [
                'required',
                Rule::unique('karyawan')->ignore($request->id),
                'max:255'
            ],
            'namalengkap' => [
                'required',
                Rule::unique('karyawan')->ignore($request->id),
                'max:255'
            ],
            'notel' => [
                'required',
            ],
            'alamat' => 'required',
            'email' =>[
                'required',
                'email',
                Rule::unique('karyawan')->ignore($request->id),
            ],
            'jeniskelamin' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'avatar'=>'image|file|max:2048|mimes:jpeg,png,jpg',
        ], [
            'nip.required' => 'The ID Number field is required.',
            'nip.unique' => 'The ID Number has already been taken.',
            'namalengkap.required' => 'The Full Name field is required',
            'namalengkap.unique' => 'The Full Name has already been taken',
            'email.required' => 'The Email field is required',
            'email.email' => 'The Email field must be a valid email address.',
            'email.unique' => 'The Email field The Full Name has already been taken',
            'tempatlahir.required' => 'The Place Of Birth field is required',
            'tanggallahir.required' => 'The Date Of Birth field is required',
            'notel.required' => 'The Phone Number field is required',
            'alamat.required' => 'The Address field is required',
            'jeniskelamin.required' => 'The Gender field is required',
            'provinsi.required' => 'The Provence field is required',
            'kabupaten.required' => 'The Distric field is required',
            'avatar.image' => 'Photo File is Image',
            'avatar.mimes' => 'Format File Must JPG,JPEG,PNG',
        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
            $karyawanid = $request->id;
            $image=$request->file('avatar');
            $name=uniqid().time();
            $destinasi=('assets/uploads/fotokaryawan');
            if($request->file('avatar')){
            KaryawanModel::updateOrCreate(
                ['id'=> $karyawanid],
                [
                    'nip'=>$request->nip,
                    'namalengkap'=>$request->namalengkap,
                    'jeniskelamin'=>$request->jeniskelamin,
                    'tempatlahir'=>$request->tempatlahir,
                    'tanggallahir'=>date('Ymd',strtotime($request->tanggallahir)),
                    'notel'=>$request->notel,
                    'email'=>$request->email,
                    'alamat'=>$request->alamat,
                    'idprovinsi'=>$request->provinsi,
                    'idkabupaten'=>$request->kabupaten,
                    'avatar'=> $image->move($destinasi,$name.'.'.$image->getClientOriginalExtension()),
                   
                ]);
                if(!empty($request->input('id'))){
                    $data=[
                        'date'=>new Carbon(),
                        'action'=>'Update',
                        'user'=>'1',
                        'note'=>'Update Karyawan',
                    ];
                    HistoryModel::create($data);
                }else{
                    $data=[
                        'date'=>new Carbon(),
                        'action'=>'Create',
                        'user'=>'1',
                        'note'=>'Create Karyawan',
                    ];
                    HistoryModel::create($data);
                 }
                return response()->json([
                    'status'=>1,
                    'success'=> 'success'
                ]);
            }else{
                KaryawanModel::updateOrCreate(
                    ['id'=>$request->id],
                    [
                        'nip'=>$request->nip,
                        'namalengkap'=>$request->namalengkap,
                        'jeniskelamin'=>$request->jeniskelamin,
                        'tempatlahir'=>$request->tempatlahir,
                        'tanggallahir'=>date('Ymd',strtotime($request->tanggallahir)),
                        'notel'=>$request->notel,
                        'email'=>$request->email,
                        'alamat'=>$request->alamat,
                        'idprovinsi'=>$request->provinsi,
                        'idkabupaten'=>$request->kabupaten,
                    ]);
                    if(!empty($request->input('id'))){
                        $data=[
                            'date'=>new Carbon(),
                            'action'=>'Update',
                            'user'=>'1',
                            'note'=>'Update Karyawan',
                        ];
                        HistoryModel::create($data);
                    }else{
                        $data=[
                            'date'=>new Carbon(),
                            'action'=>'Create',
                            'user'=>'1',
                            'note'=>'Create Karyawan',
                        ];
                        HistoryModel::create($data);
                     }
                    return response()->json([
                        'status'=>1,
                        'success'=> 'success'
                    ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
   
    public function show(string $id)
    {
        $karyawan=KaryawanModel::with(['provinsi','kabupaten'])->findorFail($id);
       return view('karyawan.show',compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $where=[
            'id'=>$request->id
        ];
        $data= KaryawanModel::where($where)->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        KaryawanModel::where('id', $id)->delete();
        $data=[
            'date'=>new Carbon(),
            'action'=>'Delete',
            'user'=>'1',
            'note'=>'Delete Karyawan',
        ];
        HistoryModel::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Berhasil Dihapus!.',
        ]);
    }
}
