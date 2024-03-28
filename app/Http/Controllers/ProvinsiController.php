<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProvinsiController extends Controller
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
        $data = Provinsi::all();
    
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Choose One</button>
                    <div class="dropdown-menu">
                        <a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-success btn-sm dropdown-item editPost" title="Ubah"><i class="fa fa-edit"></i> Edit </a>
                        
                        <a href="javascript:void(0)" id="deleteprovinsi" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-id="' . $row->id . '" data-name="' . $row->nama . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data=[
            'provinsi'=>Provinsi::orderBy('nama','asc')->get(),
        ];
        return view('provinsi.index')->with($data);


        
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
        $validasi = Validator::make($request->all(), [
            'nama' => [
                'required',
                Rule::unique('provinsi')->ignore($request->id),
                'max:255'
            ],
        ], [
            'nama.required' => 'The Provence field is required.',
            'nama.unique' => 'The Provence has already been taken.',

        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
            Provinsi::updateOrCreate(
                    ['id'=>$request->id],
                    [
                        'nama'=>$request->nama,
                    ]);
                   
            if(!empty($request->input('id'))){
                $data=[
                    'date'=>new Carbon(),
                    'action'=>'Update',
                    'user'=>'1',
                    'note'=>'Update Provinsi',
                ];
                HistoryModel::create($data);
            }else{
                $data=[
                    'date'=>new Carbon(),
                    'action'=>'Create',
                    'user'=>'1',
                    'note'=>'Create Provinsi',
                ];
                HistoryModel::create($data);
            }
            return response()->json([
                'status'=>1,
                'success'=> 'Data Berhasil'
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
        $data= Provinsi::where($where)->first();
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
        Provinsi::where('id', $id)->delete();
            $data=[
                'date'=>new Carbon(),
                'action'=>'Delete',
                'user'=>'1',
                'note'=>'Delete Provinsi',
            ];
            HistoryModel::create($data);
     
        return response()->json([
            'success' => true,
            'message' => 'Data Provinsi Berhasil Dihapus!.',
        ]);
    }
}
