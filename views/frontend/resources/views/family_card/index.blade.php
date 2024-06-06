@extends('layouts.master')

@section('web-content')
    <div class="content-wrapper">
        @include('layouts.kk_header')
        <div class="content">
            <a href="{{ route('fam-card.create') }}" class="btn btn-success ml-1">Tambah Kartu Keluarga</a>
            <div class="container-fluid">
                <div class="card">
                    <h5 class="card-title">Data Kartu Keluarga</h5>
                    <table id="table-kk" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kepala Keluarga</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($familyCards))
                            @foreach ($familyCards->data as $familyCard)
                                <tr>
                                    <td>{{ $familyCard->id }}</td>
                                    <td>{{ $familyCard->kepala_keluarga }}</td>
                                    <td>
                                        <a href="{{ route('fam-card.edit', $familyCard->id) }}" class="btn btn-warning" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('fam-card.destroy', $familyCard->id) }}" method="POST">
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
                                <td colspan="4">No data available</td>
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
