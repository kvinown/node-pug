@extends('layouts.master')

@section('web-content')
    <div class="content-wrapper">
                @include('layouts.pend_header')
        <div class="content">
            <a href="{{ route('citizen.create') }}" class="btn btn-success ml-1">Tambah Penduduk</a>
            <div class="container-fluid">
                <div class="card">
                    <h5 class="card-title">Data Penduduk</h5>
                    <table id="table-kk" width="100%" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama </th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Golongan Darah</th>
                            <th>Agama</th>
                            <th>Status</th>
                            <th>ID Kartu Keluarga</th>
                            <th>Nama Kepala Keluarga</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($citizenDatas))
                            @foreach ($citizenDatas as $citizen)
                                <tr>
                                    <td>{{ $citizen->nik }}</td>
                                    <td>{{ $citizen->nama }}</td>
                                    <td>{{ $citizen->alamat }}</td>
                                    <td>{{ $citizen->tgl_lahir }}</td>
                                    <td>{{ $citizen->gol_darah }}</td>
                                    <td>{{ $citizen->agama }}</td>
                                    <td>{{ $citizen->status }}</td>
                                    <td>{{ $citizen->kartu_keluarga_id }}</td>
                                    <td>{{ $citizen->kepala_keluarga }}</td>
                                    <td>
                                        <a href="{{ route('citizen.edit', $citizen->nik) }}" class="btn btn-warning" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('citizen.delete', $citizen->nik) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11">No data available</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('spc-css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('spc-js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $('#table-kk').DataTable();
    </script>
@endsection
