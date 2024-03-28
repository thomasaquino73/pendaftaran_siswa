@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Barang</h4>
                <a href="javascript:void(0);" id="create" type="button" class="btn btn btn-primary btn-rounded float-right">
                    <i class="fa fa-plus"></i> Tambah Data</a>
            </div>

        </div>

    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>
    </div>

    @push('scripts')
        
    @endpush
@endsection

