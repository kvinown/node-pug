@extends('layouts.master')

@section('web-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.header')
        <h1>EDIT</h1>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if($errors->any())
                    <div class="alert alert-danger">
                      {{implode('', $errors->all(':message'))}}
                    </div>
                @endif
              <div class="card p-4">
              <form method="POST" action="{{route('fam-card.update')}}">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="kk-id">Nomor Kartu Keluarga</label>
                    <input type="text" class="form-control" id="kk-id" placeholder="Nomor Kartu Keluarga" name="id" required autofocus maxlength="15" readonly
                    value="{{$familyCardData->id}}">
                  </div>
                  <div class="form-group">
                    <label for="nama-kk">Nama Kepala Keluarga</label>
                    <input type="text" maxlength="100" class="form-control" id="nama-kk" placeholder="Contoh: John Doe" required name="kepala_keluarga"
                    value="{{$familyCardData->kepala_keluarga}}">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
              </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection

@section('spc-css')
@endsection

@section('spc-js')
@endsection
