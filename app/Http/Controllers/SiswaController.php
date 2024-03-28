<?php

namespace App\Http\Controllers;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\SiswaModel;
use App\Models\ParentModel;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:student-list|student-create|student-edit|student-delete', ['only' => ['index','show']]);
        $this->middleware('permission:student-list', ['only' => ['index','show']]);
        $this->middleware('permission:student-create', ['only' => ['create','store']]);
        $this->middleware('permission:student-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:student-delete', ['only' => ['destroy']]);
        $this->middleware('permission:student-view', ['only' => ['show']]);
   }
    public function index(Request $request)
    {
            $data=[];
            if ($request->ajax()) {
                $data = SiswaModel::select('*','siswa.code as siswacode')->get();
                $user = Auth()->user();
                return Datatables::of($data)->addIndexColumn()
                ->addColumn('foto', function($row){
                    if(!empty ($row->foto)){
                    $btn = '<img width="50" height="50" src="'.asset('').$row->foto.'" class="" alt="">';
                    }else{
                     $btn = '<img width="50" height="50" src="assets/img/user.jpg" class=" " alt="">';
                    }
                    return $btn;
                })
                ->addColumn('info', function($row){
                    $tags = $row['icr_info'];
                    $tag = explode(",", $tags);
                    $btn='';
                    foreach($tag as $t){
                        $btn .= "<li class='p-1'><span style='margin-left:10px;padding:3px;' class='badge-success'>$t</span></li>";
                    }

                    return $btn;
                })
           
                    ->addColumn('action', function($row) use($user){
                        $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Action</button>
                        <div class="dropdown-menu">';
                        if ($user->can('student-edit')) {
                           $btn =$btn. '<a href="'.url('siswa/'.$row->code).'" class="btn btn-primary btn-sm dropdown-item " title="Detail"><i class="fa fa-eye"></i> Detail </a>';
                        }
                        if ($user->can('student-delete')) {
                           $btn =$btn. '<a href="javascript:void(0)" id="delete" data-toggle="tooltip" data-placement="bottom" title="Delete" data-id="' . $row->code . '" data-name="' . $row->full_name . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action','foto','info'])
                    ->make(true);
            }
            return view('siswa.index');


        
    }

    public function create()
    {
        $data=[
            'provinsi'=>Provinsi::all(),
            'kabupaten'=>Kabupaten::all(),
        ];
        return view('siswa.create')->with($data);
    }

    
    public function store(Request $request)
    {
        $data=$request->all();
        $validasi = Validator::make($request->all(), [
                        'full_name' =>[
                            'required', 
                            Rule::unique('siswa')->ignore($request->id),
                        ] ,
                        'pobstudent' => 'required',
                        'dobstudent' => 'required',
                        'gender' => 'required',
                        'nationality' => 'required',
                        'medical_conditions' => 'required',
                        'disability_condition' => 'required',
                        'address' => 'required',
                        'provinsi' => 'required',
                        'kabupaten' => 'required',
                      
                    ], [
                        'full_name.required' => 'The Full Name field is required.',
                        'full_name.unique' => 'The Full Name has already been taken.',
                        'pobstudent.required' => 'The Place Of Birth field is required.',
                        'dobstudent.required' => 'The Date Of Birth field is required.',
                        'gender.required' => 'The Gender field is required.',
                        'medical_conditions.required' => 'The Medical Conditions field is required.',
                        'disability_condition.required' => 'The Disability Conditions field is required.',
                        'address.required' => 'The Address field is required.',
                        'provinsi.required' => 'The Provence field is required.',
                        'kabupaten.required' => 'The Distric field is required.',
                    
            
                    ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
            $regsiswa=SiswaModel::latest()->first();
                    $kodesekolah="ICRST";
                    $kodetahun=date("Y");
                    if($regsiswa==null){
                        $nomorurut="0001";
                    }else{
                        $nomorurut=substr($regsiswa->reg_number,9,4)+1;
                        $nomorurut=str_pad($nomorurut,4,"0",STR_PAD_LEFT);
                    }
                    $kodeSiswa=$kodesekolah.$kodetahun.$nomorurut;
                    foreach ($request->info as $r) {
                        $resep[]=$r;
                    }
            if($request->file('foto')){
                
                foreach($request->inputs as $key=>$value){
                   $code=[
                        'full_name_parent'=>$value['full_name_parent'],
                        'family_name_parent'=>$value['family_name_parent'],
                        'relation'=>$value['relation'],
                        'email'=>$value['email'],
                        'mobile_no'=>$value['mobile_no'],
                        'office_no'=>$value['office_no'],
                        'reg_number'=>$kodeSiswa,
                        'code'=>$nomorurut
                   ];
                    ParentModel::create($code);
                    
                }

                $image=$request->file('foto');
                $name=uniqid().time();
                $destinasi=('assets/uploads/fotosiswa');
         
                $student = new SiswaModel();
                $student->full_name = $request->full_name;
                $student->family_name = $request->familynamestudent;
                $student->place_birth = $request->pobstudent;
                $student->date_birth = date('Ymd',strtotime($request->dobstudent));
                $student->gender = $request->gender;
                $student->nationality = $request->nationality;
                $student->medical_conditions = $request->medical_conditions;
                $student->medical_note = $request->medical_note;
                $student->disability_condition = $request->disability_condition;
                $student->disability_note = $request->disability_note;
                $student->address = $request->address;
                $student->idprovinsi = $request->provinsi;
                $student->idkabupaten = $request->kabupaten;
                $student->reg_number = $kodeSiswa;
                $student->code = $nomorurut;
                $student->foto =$image->move($destinasi,$name.'.'.$image->getClientOriginalExtension());
                $student->icr_info = join(', ',$resep);
                $student->save();

                return response()->json([
                'status'=>1,
                'success'=> 'success'
                ]);

            }else{
                
                $student = new SiswaModel();
                $student->full_name = $request->full_name;
                $student->family_name = $request->familynamestudent;
                $student->place_birth = $request->pobstudent;
                $student->date_birth = date('Ymd',strtotime($request->dobstudent));
                $student->gender = $request->gender;
                $student->nationality = $request->nationality;
                $student->medical_conditions = $request->medical_conditions;
                $student->medical_note = $request->medical_note;
                $student->disability_condition = $request->disability_condition;
                $student->disability_note = $request->disability_note;
                $student->address = $request->address;
                $student->idprovinsi = $request->provinsi;
                $student->idkabupaten = $request->kabupaten;
                $student->reg_number = $kodeSiswa;
                $student->code = $nomorurut;
                $student->icr_info = join(', ',$resep);
                $student->save();
                                
                foreach($request->inputs as $key=>$value){
                    $code=[
                         'full_name_parent'=>$value['full_name_parent'],
                         'family_name_parent'=>$value['family_name_parent'],
                         'relation'=>$value['relation'],
                         'email'=>$value['email'],
                         'mobile_no'=>$value['mobile_no'],
                         'office_no'=>$value['office_no'],
                         'reg_number'=>$kodeSiswa,
                         'code'=>$nomorurut
                    ];
                     ParentModel::create($code);
                     
                 }

                return response()->json([
                    'status'=>1,
                    'success'=> 'success'
                ]);
            }
          
                return response()->json([
                    'status'=>1,
                    'success'=> 'success'
                ]);
        }
    }

    public function show(string $id)
    {
        $where=[
            'siswa.code'=>$id
        ];
        
   
        $siswa= SiswaModel::with(['provinsi','kabupaten'])
        ->where($where)
        ->firstOrFail();
       return view('siswa.show',compact('siswa'));
    }
    public function tableparent(Request $request,$id){
        if ($request->ajax()) {
            $where=[
                'siswa.code'=>$id
            ];
            $data = SiswaModel::select('*','siswa.code as siswacode')->join('parent','parent.code','=','siswa.code','')
            ->where($where)->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('info', function($row){
                $tags = $row['icr_info'];
                $tag = explode(",", $tags);
                $btn='';
                foreach($tag as $t){
                    $btn .= "<li class='p-1'><span style='margin-left:10px;padding:3px;' class='badge-success'>$t</span></li>";
                }

                return $btn;
            })
       
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu">
                        <a href="'.url('siswa/'.$row->code).'" class="btn btn-primary btn-sm dropdown-item " title="Detail"><i class="fa fa-eye"></i> Detail </a>
                        
                        <a href="javascript:void(0)" id="delete" data-toggle="tooltip" data-placement="bottom" title="Delete" data-id="' . $row->code . '" data-name="' . $row->full_name . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';
                    return $btn;
                })
                ->rawColumns(['action','foto','info'])
                ->make(true);
        }
    }
    public function parent($id)
    {
        $where=[
            'siswa.code'=>$id
        ];
        $siswa= SiswaModel::with(['provinsi','kabupaten'])
        ->where($where)
        ->firstOrFail();
       return view('siswa.parent',compact('siswa'));
    
    }
    public function edit($id)
    {

        $where=[
            'siswa.code'=>$id
        ];
        $siswa= SiswaModel::with(['provinsi','kabupaten'])
        ->where($where)
        ->first();
        return view('siswa.edit',[
            'icr_info' => explode(',',$siswa->icr_info),
        ],compact('siswa'));
    }

    // public function edit(Request $request)
    // {

    //     $where=[
    //         'id'=>$request->id
    //     ];
    //     $data= SiswaModel::where($where)->first();
    //     return response()->json($data);
    // }
 
    public function update(Request $request, string $id)
    {
        return redirect()->back();
  
    }

    public function destroy($id)
    {
        SiswaModel::where('code', $id)->delete();
        ParentModel::where('code', $id)->delete();
        $data=[
            'date'=>new Carbon(),
            'action'=>'Delete',
            'user'=>'1',
            'note'=>'Delete Kategori',
        ];
        HistoryModel::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Data Kategori Berhasil Dihapus!.',
        ]);
    }
}
