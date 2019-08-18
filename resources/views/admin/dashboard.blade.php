@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
    <style>
        .clickable-row{
            cursor: pointer;
        }
    </style>

@endsection

@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>Daftar Mahasiswa yang mengisi form</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="mahasiswa-table">
                        <thead>
                        <tr>
                            <th width="3%">No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>No HP</th>
                            <th width="5%">Form 1</th>
                            <th width="5%">Form 2</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <form action="/admin/mahasiswa/-1/destroy" method="post" id="delete-form">
        @csrf

    </form>

@endsection

@section('js')
    <script type="text/javascript">
        $('#mahasiswa-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ url('ajax/mahasiswa') }}',
            columns: [
                {data: 'no'},
                {data: 'nama'},
                {data: 'nim'},
                {data: 'no_hp'},
                {data: 'form_1'},
                {data: 'form_2'},
                {data: 'tanggal'},
                {data: 'action'},
            ],
        });

        function deleteData(id) {
            $('#delete-form').attr('action', '/admin/mahasiswa/'+ id +'/destroy');
            $('#delete-form').submit();
        }
    </script>
@endsection