<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-list', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:user-view', ['only' => ['show']]);

    }
    public function index(Request $request)
    {
        $x=[
            'roles'     =>Role::pluck('name','name')->all(),
            'karyawan'  =>KaryawanModel::all(),
            // 'userRole'=>$user->roles->pluck('name','name')->all(),
        ];
       
            if ($request->ajax()) {
                $data = User::select('*','users.id as userid')->with(['karyawan'])
                ->get();
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Action</button>
                        <div class="dropdown-menu">
                            <a href="javascript:void(0);" data-id="' . $row->userid . '" class="btn btn-success btn-sm dropdown-item editPost" title="Ubah"><i class="fa fa-edit"></i> Edit </a>
                            
                            <a href="javascript:void(0)" id="deletecategory" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-id="' . $row->userid . '" data-name="' . $row->email . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
                        return $btn;
                    })
                    ->addColumn('roles',function($row)  {
                        if(!empty($row->getRoleNames()))
                        foreach($row->getRoleNames() as $v){
                            return  $v;
                        }
                    })
                    ->addColumn('namalengkap',function($row)  {
                        $data = User::select('*')
                        ->join('karyawan',DB::raw('BINARY users.username'), '=', DB::raw('BINARY karyawan.nip'),'left')
                        ->find($row->id);
                        $btn=$data->namalengkap;
                        return $btn;
                    })
                    ->rawColumns(['action','roles','namalengkap'])
                    ->make(true);
            }
            return view('pengguna.index')->with($x);
    }

    public function create()
    {
        $data=[
            'karyawan'  =>KaryawanModel::all(),
            'roles'     =>Role::pluck('name','name')->all(),
        ];
        return view('pengguna.create')->with($data);
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'fullname' =>[
                'required',
                Rule::unique('users')->ignore($request->id),
            ], 
            'username'=>[
                'required',
                Rule::unique('users')->ignore($request->id),
            ],
            'password'=>'required|same:confirm-password',
            'confirm'=>'required',
            'roles'=>'required',
        ], [
            'fullname.required' => 'The Teacher Name field is required',
            'fullname.unique' => 'The Teacher Name has already been taken',
            'username.required' => 'The Username field is required',
            'password.required' => 'The Password field is required',
            'password.same' => 'The Password field must match Confirm Password',
            'confirm.required' => 'The Confirm Password field is required',
            'roles.required' => 'The Roles field is required',

        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['created_at'] = new Carbon();
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
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
        $data=User::where($where)->first();
         $data->roles->pluck('name','name')->all();

        return response()->json($data);
    }
 
    public function update(Request $request, string $id)
    {
        //
  
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
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
