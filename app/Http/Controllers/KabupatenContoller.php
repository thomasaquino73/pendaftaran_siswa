<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KabupatenContoller extends Controller
{
    function __construct()
    {
        $this->middleware('permission:area-list|area-create|area-edit|area-delete', ['only' => ['index','show']]);
        $this->middleware('permission:area-list', ['only' => ['index','show']]);
        $this->middleware('permission:area-create', ['only' => ['create','store']]);
        $this->middleware('permission:area-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:area-delete', ['only' => ['destroy']]);
        $this->middleware('permission:area-view', ['only' => ['show']]);
   }
    public function index(Request $request)
    {

        $data=[];
        $data = Kabupaten::select('*','kabupaten.nama as namakabupaten','provinsi.nama as namaprovinsi','provinsi_id as idprovinsi','kabupaten.id as idkabupaten')->join('provinsi','provinsi.id','=','kabupaten.provinsi_id')->get();
       
            if ($request->ajax()) {
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Choose One</button>
                        <div class="dropdown-menu">
                            <a href="javascript:void(0);" data-id="' . $row->idkabupaten . '" class="btn btn-success btn-sm dropdown-item editPost" title="Ubah"><i class="fa fa-edit"></i> Edit </a>
                            
                            <a href="javascript:void(0)" id="deletekabupaten" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-id="' . $row->idkabupaten . '" data-name="' . $row->namakabupaten . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $data=[
                'provinsi'=>Provinsi::orderBy('nama','asc')
                ->get(),
                'kabupaten'=>Kabupaten::orderBy('nama','asc')
                ->get(),
            ];
            return view('kabupaten.index')->with($data);


        
    }

    public function getProvinsi(request $request){
        $search = $request->search;
        if ($search==''){
            $kota=Kabupaten::orderBy('nama','asc')
            ->select('id','nama')
            ->limit(5)
            ->get();
        }else{
            $kota=Kabupaten::orderBy('nama','asc')
            ->select('id','nama')
            ->where('nama','like','%'.$search.'%')
            ->limit(5)
            ->get();
        }
        $response=array();
        foreach ($kota as $kota){
            $response[]=array([
                'id'=>$kota->id,
                'text'=>$kota->nama,
            ]);
        }
        return response()->json($response);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'provinsi_id' => [
                'required',
                'max:255'
            ],
            'nama' => [
                'required',
                Rule::unique('kabupaten')->ignore($request->id),
                'max:255'
            ],
        ], [
            'provinsi_id.required' => 'The Provence field is required.',
            'nama.required' => 'The Distric field is required.',
            'nama.unique' => 'The Distric has already been taken.',
        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
            Kabupaten::updateOrCreate(
                    ['id'=>$request->id],
                    [
                        'provinsi_id'=>$request->provinsi_id,
                        'nama'=>$request->nama,
                    ]);
                   
            if(!empty($request->input('id'))){
                $data=[
                    'date'=>new Carbon(),
                    'action'=>'Update',
                    'user'=>'1',
                    'note'=>'Update Kabupaten',
                ];
                HistoryModel::create($data);
            }else{
                $data=[
                    'date'=>new Carbon(),
                    'action'=>'Create',
                    'user'=>'1',
                    'note'=>'Create Kabupaten',
                ];
                HistoryModel::create($data);
            }
            return response()->json([
                'status'=>1,
                'success'=> 'success'
            ]);
        }

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
    public function edit(Request $request)
    {

        $where=[
            'id'=>$request->id
        ];
        $data= Kabupaten::where($where)->first();
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
        Kabupaten::where('id', $id)->delete();
            $data=[
                'date'=>new Carbon(),
                'action'=>'Delete',
                'user'=>'1',
                'note'=>'Delete Kabupaten',
            ];
            HistoryModel::create($data);
     
        return response()->json([
            'success' => true,
            'message' => 'Data Kabupaten Berhasil Dihapus!.',
        ]);
    }
}
