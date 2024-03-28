<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\CabangModel;
use App\Models\KursusModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KursusController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index','show']]);
        $this->middleware('permission:course-list', ['only' => ['index','show']]);
        $this->middleware('permission:course-create', ['only' => ['create','store']]);
        $this->middleware('permission:course-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:course-delete', ['only' => ['destroy']]);
        $this->middleware('permission:course-view', ['only' => ['show']]);
   }
    public function index(Request $request)
    {

        $data=[];
       
            if ($request->ajax()) {
                $data = KursusModel::select('*','kursus.id as kursusid')->join('cabang','kursus.idcenter','=','cabang.id','left')
                ->join('kelas','kursus.classid','=','kelas.id','left')
                ->join('karyawan','kursus.idkaryawan','=','karyawan.id','left')
                ->join('siswa','kursus.idsiswa','=','siswa.id','left')
                ->get();
                $user = Auth()->user();
                
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function($row) use($user){
                        $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Action</button>
                        <div class="dropdown-menu">';
                        if ($user->can('course-edit')) {
                        $btn=$btn.'<a href="'.url('kursus/'.$row->kursusid).'/edit" class="btn btn-success btn-sm dropdown-item " title="Edit"><i class="fa fa-edit"></i> Edit </a>
                            <a href="'.url('kursus/'.$row->kursusid).'" class="btn btn-primary btn-sm dropdown-item " title="detail"><i class="fa fa-eye"></i> Detail </a>';
                        }
                        if ($user->can('course-edit')) {
                        $btn=$btn.' <a href="javascript:void(0)" id="deletecategory" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-id="' . $row->kursusid . '" data-name="' . $row->full_name . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';}
                        return $btn;
                    })
                    // ->addColumn('material', function($row){
                    //     $tags = $row['icr_info'];
                    //     $tag = explode(",", $tags);
                    //     $btn='';
                    //     foreach($tag as $t){
                    //         $btn .= "<li class='p-1'><span style='margin-left:10px;padding:3px;' class='badge-success'>$t</span></li>";
                    //     }
    
                    //     return $btn;
                    // })
                    ->addColumn('material', function($row){
                            $a=explode(',',$row->materialissued);
                            $b=count($a);
                            $btn='';
                            for($x=0;$x<$b ;$x++){
                                $btn .="<li class='p-1'><span style='margin-left:10px;padding:3px;'  class='badge-success ' style='margin-right:10px'>".$a[$x]."</span></li>";
                            }
                            return $btn;
                    })
                    ->rawColumns(['action','material'])
                    ->make(true);
            }
            $data=[
            'cabang'=>CabangModel::all(),
            'kelas'=>KelasModel::all(),
            'karyawan'=>KaryawanModel::all(),
            'siswa'=>SiswaModel::all(),
            ];
            return view('kursus.index')->with($data);


        
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
                        'studentname' => 'required',
                        'regdate' => 'required',
                        'nopendaftaran' => 'required|unique:kursus,nopendaftaran',
                        'startdate' => 'required',
                        'idkelas' => 'required|unique:kursus,classid',//classID
                        'center' => 'required',
                        'classroom' => 'required',
                        'attended' => 'required',
                    ], [
                        'studentname.required' => 'The Student Name field is required.',
                        'studentname.unique' => 'The Student Name has already been taken.',
                        'regdate.required' => 'The Registration Date field is required.',
                        'nopendaftaran.required' => 'The Receipt Number field is required.',
                        'nopendaftaran.unique' => 'The Receipt Number has already been taken.',
                        'startdate.required' => 'The Start Date field is required.',
                        'idkelas.required' => 'The Class ID field is required.',
                        'idkelas.unique' => 'The Class ID has already been taken.',
                        'center.required' => 'The Center Office field is required.',
                        'classroom.required' => 'The Classroom field is required.',
                        'attended.required' => 'The Attended field is required.',
                      
            
                    ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
                $regsiswa=KursusModel::latest()->first();
                $kodesekolah="ICRNS";
                $kodetahun=date("Y");
                if($regsiswa==null){
                    $nomorurut="0001";
                }else{
                    $nomorurut=substr($regsiswa->reg_number,9,4)+1;
                    $nomorurut=str_pad($nomorurut,4,"0",STR_PAD_LEFT);
                }
                $kodeSiswa=$kodesekolah.$kodetahun.$nomorurut;
                foreach ($request->material_issued as $r) {
                    $resep[]=$r;
                }
     
                    KursusModel::create(
                        [
                            'idsiswa' => $request->studentname,
                            'regdate' => date('Ymd',strtotime($request->regdate)),
                            'nopendaftaran' => $request->nopendaftaran,
                            'startdate' => date('Ymd',strtotime($request->startdate)),
                            'classid' => $request->idkelas,
                            'idcenter' => $request->center,
                            'idclassroom' => $request->classroom,
                            'idkaryawan' => $request->attended,
                            'reg_number' => $kodeSiswa,
                            'materialissued' => join(',',$resep)
                        ]);
    
              
                    return response()->json([
                    'status'=>1,
                    'success'=> 'success'
                ]);
            
        }
    }
    public function update(Request $request)
    {
        $validasi = Validator::make($request->all(), [
                        'studentname' => [
                            'required',
                            Rule::unique('siswa','full_name')->ignore($request->id),
                            'max:255'
                        ],
                        'regdate' => 'required',
                        'nopendaftaran' => [
                            'required',
                            Rule::unique('kursus','nopendaftaran')->ignore($request->id),
                            'max:255'
                        ],
                 
                        'startdate' => 'required',
                        'idkelas' => 'required',//classID
                        'center' => 'required',
                        'classroom' => 'required',
                        'attended' => 'required',
                    ], [
                        'studentname.required' => 'The Student Name field is required.',
                        'studentname.unique' => 'The Student Name has already been taken.',
                        'regdate.required' => 'The Registration Date field is required.',
                        'nopendaftaran.required' => 'The Receipt Number field is required.',
                        'nopendaftaran.unique' => 'The Receipt Number has already been taken.',
                        'startdate.required' => 'The Start Date field is required.',
                        'idkelas.required' => 'The Class ID field is required.',
                        'center.required' => 'The Center Office field is required.',
                        'classroom.required' => 'The Classroom field is required.',
                        'attended.required' => 'The Attended field is required.',
                      
            
                    ]);
        if ($validasi->fails()) {
            return response()->json([
                'status'=> 0,
                'error' => $validasi->errors()->toArray(),
            ]);
        } else {
            $id=$request->id;
                foreach ($request->material_issued as $r) {
                    $resep[]=$r;
                }
         
                    $data=[
                            'idsiswa' => $request->studentname,
                            'regdate' => date('Ymd',strtotime($request->regdate)),
                            'nopendaftaran' => $request->nopendaftaran,
                            'startdate' => date('Ymd',strtotime($request->startdate)),
                            'classid' => $request->classid,
                            'idcenter' => $request->center,
                            'classid' => $request->idkelas,
                            'idclassroom' => $request->classroom,
                            'idkaryawan' => $request->attended,
                            'materialissued' => join(',',$resep)
                        ];
                        KursusModel::where('id', $id)->update($data);
              
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
        $where=[
            'kursus.id'=>$id
        ];
        $data= KursusModel::select('*','kursus.id as kursusid','cabang.id as cabangid','kelas.id as kelasid','karyawan.id as karyawanid','siswa.id as siswaid', 'provinsi.nama as namapropinsi','kabupaten.nama as namakabupaten')
        ->join('cabang','kursus.idcenter','=','cabang.id','left')
        ->join('kelas','kursus.classid','=','kelas.id','left')
        ->join('karyawan','kursus.idkaryawan','=','karyawan.id','left')
        ->join('siswa','kursus.idsiswa','=','siswa.id','left')
        ->join('provinsi','provinsi.id','=','siswa.idprovinsi','left')
        ->join('kabupaten','kabupaten.id','=','siswa.idkabupaten','left')
        ->where($where)->firstorfail();
        $tags = $data['materialissued'];
                        $tag = explode(",", $tags);
                        $btn='';
                        foreach($tag as $t){
                            $btn .= $t;
                        }
              
        $select=[
            'cabang'=>CabangModel::all(),
            'kelas'=>KelasModel::all(),
            'karyawan'=>KaryawanModel::all(),
            'siswa'=>SiswaModel::all(),

            'gender'=>$data->gender,
            'fullname'=>$data->full_name,
            'pob'=>$data->place_birth,
            'dob'=>$data->date_birth,
            'nationality'=>$data->nationality,
            'address'=>$data->address,
            'propinsi'=>$data->namapropinsi,
            'kabupaten'=>$data->namakabupaten,
            'sisw'=>$data->siswaid,
            'regnumber'=>$data->reg_number,
            'nopendaftaran'=>$data->nopendaftaran,
            'regdate'=>$data->regdate,
            'startdate'=>$data->startdate,
            'classid'=>$data->classid,
            'idsiswa'=>$data->idsiswa,
            'foto'=>$data->foto,
            'center'=>$data->idcenter,
            'classroom'=>$data->idclassroom,
            'karyawans'=>$data->karyawanid,
            'id'=>$data->kursusid,
            'material' => explode(',',$data->materialissued),
            ];
        return view('kursus.show')->with($select);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $where=[
            'kursus.id'=>$id
        ];
        $data= KursusModel::select('*','kursus.id as kursusid','cabang.id as cabangid','kelas.id as kelasid','karyawan.id as karyawanid','siswa.id as siswaid')
        ->join('cabang','kursus.idcenter','=','cabang.id','left')
        ->join('kelas','kursus.classid','=','kelas.id','left')
        ->join('karyawan','kursus.idkaryawan','=','karyawan.id','left')
        ->join('siswa','kursus.idsiswa','=','siswa.id','left')
        ->where($where)->firstorfail();
        $select=[
            'cabang'=>CabangModel::all(),
            'kelas'=>KelasModel::all(),
            'karyawan'=>KaryawanModel::all(),
            'siswa'=>SiswaModel::all(),
            'sisw'=>$data->siswaid,
            'regnumber'=>$data->reg_number,
            'nopendaftaran'=>$data->nopendaftaran,
            'regdate'=>$data->regdate,
            'startdate'=>$data->startdate,
            'classid'=>$data->classid,
            'idsiswa'=>$data->idsiswa,
            'center'=>$data->idcenter,
            'classroom'=>$data->idclassroom,
            'karyawans'=>$data->karyawanid,
            'id'=>$data->kursusid,
            'material' => explode(',',$data->materialissued),
            ];
        return view('kursus.edit')->with($select);
    }


    public function destroy($id)
    {
        KursusModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted.',
        ]);
    }
}
