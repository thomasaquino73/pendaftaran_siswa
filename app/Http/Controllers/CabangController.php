<?php

namespace App\Http\Controllers;
use App\Models\CabangModel;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CabangController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:center-list|center-create|center-edit|center-delete', ['only' => ['index','show']]);
        $this->middleware('permission:center-list', ['only' => ['index','show']]);
        $this->middleware('permission:center-create', ['only' => ['create','store']]);
        $this->middleware('permission:center-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:center-delete', ['only' => ['destroy']]);
        $this->middleware('permission:center-view', ['only' => ['show']]);
   }
    public function index(Request $request)
    {

        $data=[];
       
            if ($request->ajax()) {
                $data = CabangModel::all();
                $user = Auth()->user();
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function($row) use($user){
                        $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Action</button>
                        <div class="dropdown-menu">';
                        if ($user->can('center-edit')) {
                            $btn = $btn.' <a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-success btn-sm dropdown-item editPost" title="Ubah"><i class="fa fa-edit"></i> Edit </a>';
                        }
                        if ($user->can('center-delete')) {
                            $btn = $btn.' <a href="javascript:void(0)" id="deletecategory" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-id="' . $row->id . '" data-name="' . $row->namacabang . '" class="btn btn-danger dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>'; }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('cabang.index');


        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'namacabang' => 'required',
            Rule::unique('cabang')->ignore($request->id),
        ], [
            'namacabang.required' => 'The Center Name field is required',
            'namacabang.unique' => 'The Center Name has already been taken',

        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
            CabangModel::updateOrCreate(
                    ['id'=>$request->id],
                    [
                        'namacabang'=>$request->namacabang,
                        'kategori'=>$request->kategori,
                    ]);
                    
                    return response()->json([
                        'status'=>1,
                        'success'=> 'Successfully'
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
        $data= CabangModel::where($where)->first();
        return response()->json($data);
    }
 
    public function update(Request $request, string $id)
    {
        //
  
    }

    public function destroy($id)
    {
        CabangModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted.',
        ]);
    }
}
