@extends('layouts.master')

@section('web-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.pend_header')0
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
                  <form method="POST" action="{{ route('citizen.update') }}">
                      @csrf
                      <div class="form-group">
                          <label for="nik">NIK</label>
                          <input class="form-control" type="text" name="nik" id="nik" placeholder="NIK Citizen" required autofocus maxlength="15" readonly
                                 value="{{$citizenData->nik}}">
                      </div>
                      <div class="form-group">
                          <label for="nama">Nama</label>
                          <input class="form-control" type="text" name="nama" id="nama" placeholder="Contoh: John Doe" required maxlength="100"
                          value="{{$citizenData->nama}}">
                      </div>
                      <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Contoh: Jl A no 1" required maxlength="100"
                          value="{{$citizenData->alamat}}">
                      </div>
                      <div class="form-group">
                          <label for="tgl_lahir">Tanggal Lahir</label>
                          <input class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" required
                          value="{{$citizenData->tgl_lahir}}">
                      </div>
                      <div class="form-group">
                          <label for="gol_darah">Golongan Darah</label>
                          <select class="form-control" name="gol_darah" id="gol_darah">
                              <option value="{{$citizenData->gol_darah}}">{{$citizenData->gol_darah}}</option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="AB">AB</option>
                              <option value="O">O</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="agama">Agama</label>
                          <input class="form-control" type="text" name="agama" id="agama" placeholder="agama" required maxlength="100"
                          value="{{$citizenData->agama}}">
                      </div>
                      <div class="form-group">
                          <label for="status">Status</label>
                          <select class="form-control" name="status" id="status">
                              <option value="{{$citizenData->status}}">{{$citizenData->status}}</option>
                              <option value="Menikah">Menikah</option>
                              <option value="Belum Menikah">Belum Menikah</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="kartu_keluarga_id">ID Kartu Keluarga</label>
                          <select class="form-control" name="kartu_keluarga_id" id="kartu_keluarga_id">
                              <option value="{{$citizenData->kartu_keluarga_id}}">{{$citizenData->kartu_keluarga_id}}</option>
                              @foreach ($familyCardDatas as $familyCard)
                                  <option value="{{ $familyCard->id }}">{{ $familyCard->kepala_keluarga }}</option>
                              @endforeach
                          </select>
                      </div>
                      <button class="btn btn-primary" type="submit">Submit</button>
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
