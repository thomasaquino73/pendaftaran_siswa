<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //      $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:role-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::orderBy('id','DESC');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu">
                    <a class="btn btn-success btn-sm dropdown-item" href="'. route('roles.edit',$row->id) .'" > <i class="fa fa-edit "> </i> Edit</a>
                        
                        <a href="javascript:void(0)" id="delete" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-id="' . $row->id . '" data-name="' . $row->name . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('roles.index');
      
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = [
            'role'=>Permission::where('name','like','role%')->get(),
            'user'=>Permission::where('name','like','user%')->get(),
            'area'=>Permission::where('name','like','area%')->get(),
            'company'=>Permission::where('name','like','company%')->get(),
            'classroom'=>Permission::where('name','like','classroom%')->get(),
            'center'=>Permission::where('name','like','center%')->get(),
            'teacher'=>Permission::where('name','like','teacher%')->get(),
            'student'=>Permission::where('name','like','student%')->get(),
            'course'=>Permission::where('name','like','course%')->get(),
            
        ];
        return view('roles.create')->with($permission);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
              'required',
              Rule::unique('roles')->ignore($request->id),
            ],
            'permission' => 'required',
        ],[
            'name.required'=>'The Name Field is Required'
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        $notifikasi = array(
            'pesan' => 'Add Data Successfully',
            'alert' => 'success',
        );
        return redirect()->route('roles.index')
                        ->with($notifikasi);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $role = Role::find($id);
        // $permission = Permission::get();
        $permission = [
            'role'=>Role::find($id),
            'roles'=>Permission::where('name','like','role%')->get(),
            'user'=>Permission::where('name','like','user%')->get(),
            'area'=>Permission::where('name','like','area%')->get(),
            'company'=>Permission::where('name','like','company%')->get(),
            'classroom'=>Permission::where('name','like','classroom%')->get(),
            'center'=>Permission::where('name','like','center%')->get(),
            'teacher'=>Permission::where('name','like','teacher%')->get(),
            'student'=>Permission::where('name','like','student%')->get(),
            'course'=>Permission::where('name','like','course%')->get(),
            'rolePermissions'=>DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all(),
        ];
        // $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        //     ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //     ->all();
    
        return view('roles.edit')->with($permission);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
        $notifikasi = array(
            'pesan' => 'Edit Data Successfully',
            'alert' => 'success',
        );
        return redirect()->route('roles.index')
                        ->with($notifikasi);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id', $id)->delete();
        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'message.',
        ]);
    }
}