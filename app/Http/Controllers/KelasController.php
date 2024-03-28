<?php

namespace App\Http\Controllers;
use App\Models\KelasModel;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:classroom-list|classroom-create|classroom-edit|classroom-delete', ['only' => ['index','show']]);
        $this->middleware('permission:classroom-list', ['only' => ['index','show']]);
        $this->middleware('permission:classroom-create', ['only' => ['create','store']]);
        $this->middleware('permission:classroom-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:classroom-delete', ['only' => ['destroy']]);
        $this->middleware('permission:classroom-view', ['only' => ['show']]);
   }
    public function index(Request $request)
    {

        $data=[];
       
            if ($request->ajax()) {
                $data = KelasModel::all();
                $user = Auth()->user();
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function($row) use ($user){
                        $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Action</button>
                        <div class="dropdown-menu">';
                        if ($user->can('classroom-edit')) {
                            $btn = $btn . ' <a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-success btn-sm dropdown-item editPost" title="Ubah"><i class="fa fa-edit"></i> Edit </a>';
                        }
                        if ($user->can('classroom-delete')) {
                            $btn = $btn . ' <a href="javascript:void(0)" id="deletecategory" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-id="' . $row->id . '" data-name="' . $row->namakelas . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';}
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('kelas.index');


        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'namakelas' => 'required',
            Rule::unique('kelas')->ignore($request->id),
        ], [
            'namakelas.required' => 'The Classroom field is required',
            'namakelas.unique' => 'The Classroom has already been taken',

        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
            KelasModel::updateOrCreate(
                    ['id'=>$request->id],
                    [
                        'namakelas'=>$request->namakelas,
                    ]);
                    if(!empty($request->input('id'))){
                        $data=[
                            'date'=>new Carbon(),
                            'action'=>'Update',
                            'user'=>'1',
                            'note'=>'Update Class',
                        ];
                        HistoryModel::create($data);
                    }else{
                        $data=[
                            'date'=>new Carbon(),
                            'action'=>'Create',
                            'user'=>'1',
                            'note'=>'Create Class',
                        ];
                        HistoryModel::create($data);
                    }
                    return response()->json([
                        'status'=>1,
                        'success'=> 'Data Berhasil'
                    ]);
        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(Request $request)
    {

        $where=[
            'id'=>$request->id
        ];
        $data= KelasModel::where($where)->first();
        return response()->json($data);
    }
 
    public function update(Request $request, string $id)
    {
        //
  
    }

    public function destroy($id)
    {
        KelasModel::where('id', $id)->delete();
        $data=[
            'date'=>new Carbon(),
            'action'=>'Delete',
            'user'=>'1',
            'note'=>'Delete Class',
        ];
        HistoryModel::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Deleted.',
        ]);
    }
}
