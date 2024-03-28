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
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
    public function index(Request $request)
    {
        $data=[];
       
            if ($request->ajax()) {
                $data = SiswaModel::select('*','siswa.code as siswacode')->get();
                return Datatables::of($data)->addIndexColumn()
                ->addColumn('foto', function($row){
                    if(!empty ($row->foto)){
                    $btn = '<img width="50" height="50" src="'.asset('').$row->foto.'" class="" alt="">';
                    }else{
                     $btn = '<img width="50" height="50" src="assets/img/user.jpg" class=" " alt="">';
                    }
                    return $btn;
                })
           
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Aksi</button>
                        <div class="dropdown-menu">
                            <a href="'.url('siswa/'.$row->code).'" class="btn btn-primary btn-sm dropdown-item " title="Detail"><i class="fa fa-eye"></i> Detail </a>
                            
                            <a href="javascript:void(0)" id="delete" data-toggle="tooltip" data-placement="bottom" title="Delete" data-id="' . $row->id . '" data-name="' . $row->full_name . '" class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
                        return $btn;
                    })
                    ->rawColumns(['action','foto'])
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
        return view('parent.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
                'fullnamestudent' => 'required',
                Rule::unique('siswa')->ignore($request->id),
                'familynamestudent' => 'required',
                'pobstudent' => 'required',
                'dobstudent' => 'required',
                'gender' => 'required',
                'nationality' => 'required',
                'medical_conditions' => 'required',
                'disability_condition' => 'required',
                'address' => 'required',
            ], [
                'fullnamestudent.required' => 'The Full Name field is required.',
                'fullnamestudent.unique' => 'The Full Name has already been taken.',
                'familynamestudent.required' => 'The Family Name field is required.',
                'pobstudent.required' => 'The Place Of Birth field is required.',
                'dobstudent.required' => 'The Date Of Birth field is required.',
                'gender.required' => 'The Gender field is required.',
                'medical_conditions.required' => 'The Medical Conditions field is required.',
                'disability_condition.required' => 'The Disability Conditions field is required.',
                'address.required' => 'The Address field is required.',
    
            ]);
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
                $image=$request->file('foto');
                $name=uniqid().time();
                $destinasi=('assets/uploads/fotosiswa');
              

                    $student = new SiswaModel();
                    $student->full_name = $request->fullnamestudent;
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
                    $student->code = $$nomorurut;
                    $student->foto =$image->move($destinasi,$name.'.'.$image->getClientOriginalExtension());
                    $student->icr_info = join(', ',$resep);
                    $student->save();

              
            }else{
                
                    $student = new SiswaModel();
                    $student->full_name = $request->fullnamestudent;
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

                 
            }
                $notifikasi = array(
                    'pesan' => 'Data Added Succesfully',
                    'alert' => 'success',
                );
                return redirect()->route('siswa.index')->with($notifikasi);

        // $validasi = Validator::make($request->all(), [
        //     'fullnamestudent' => 'required',
        //     Rule::unique('siswa')->ignore($request->id),
        // ], [
        //     'fullnamestudent.required' => 'The ID Number field is required.',
        //     'fullnamestudent.unique' => 'The ID Number has already been taken.',
        // ]);
        // if ($validasi->fails()) {
        //     $notifikasi = array(
        //         'pesan' => 'Please Check The Form',
        //         'alert' => 'error',
        //     );
        //     return redirect()->back()->with($notifikasi);
        //     // return redirect()->route('siswa.create')->with($notifikasi);
        // } else {
        //     $image=$request->file('foto');
        //     $name=uniqid().time();
        //     $destinasi=('assets/uploads/fotosiswa');
        //     if($request->file('foto')){
        //     SiswaModel::create([
        //         'full_name' => $request->fullnamestudent,
        //         'family_name' => $request->familynamestudent,
        //         'place_birth' => $request->pobstudent,
        //         'place_birth' => $request->pobstudent,
        //         'gender' => $request->gender,
        //         'nationality' => $request->nationality,
        //         'medical_conditions' => $request->medical_conditions,
        //         'medical_note' => $request->medical_note,
        //         'disability_note' => $request->disability_note,
        //         'address' => '1',
        //         'idprovinsi' => '1',
        //         'idkabupaten' => '1',
        //         'disability_condition' => $request->disability_condition,
        //         'date_birth' => date('Ymd',strtotime($request->dobstudent)),
        //         'reg_number' => '1',
        //            'foto'=> $image->move($destinasi,$name.'.'.$image->getClientOriginalExtension()),
        //     ]);
        // }else{
        //     SiswaModel::create([
        //         'full_name' => $request->fullnamestudent,
        //         'family_name' => $request->familynamestudent,
        //         'place_birth' => $request->pobstudent,
        //         'place_birth' => $request->pobstudent,
        //         'gender' => $request->gender,
        //         'nationality' => $request->nationality,
        //         'medical_conditions' => $request->medical_conditions,
        //         'medical_note' => $request->medical_note,
        //         'disability_note' => $request->disability_note,
        //         'address' => '1',
        //         'idprovinsi' => '1',
        //         'idkabupaten' => '1',
        //         'disability_condition' => $request->disability_condition,
        //         'date_birth' => date('Ymd',strtotime($request->dobstudent)),
        //         'reg_number' => '1',
        //     ]);
        // }
        //     $notifikasi = array(
        //         'pesan' => 'Data Added Succesfully',
        //         'alert' => 'success',
        //     );
        //     return redirect()->route('siswa.index')->with($notifikasi);
        // }

    }
    

    public function show(string $id)
    {
        $where=[
            'siswa.code'=>$id
        ];
        $siswa= SiswaModel::with(['provinsi','kabupaten'])
        ->where($where)
        ->first();
        // $siswa=SiswaModel::with(['provinsi','kabupaten'])->findorFail($id);
       return view('siswa.show',compact('siswa'));
    }
    public function parent()
    {

    
    }

    public function edit(Request $request)
    {

        $where=[
            'id'=>$request->id
        ];
        $data= SiswaModel::where($where)->first();
        return response()->json($data);
    }
 
    public function update(Request $request, string $id)
    {
        //
  
    }

    public function destroy($id)
    {
        SiswaModel::where('id', $id)->delete();
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
