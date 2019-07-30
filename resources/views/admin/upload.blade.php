@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
    <style>
        .clickable-row {
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
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Tanggal Upload</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form action="/admin/upload/destroy" method="post" id="delete-form">
        @csrf
        <input type="hidden" value="-1" id="delete-upload-id" name="id">
    </form>

@endsection

@section('js')
    <script type="text/javascript">
        $('#mahasiswa-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ url('ajax/mahasiswa/upload') }}',
            columns: [
                {data: 'no'},
                {data: 'mahasiswa.nama'},
                {data: 'mahasiswa.nim'},
                {data: 'tanggal'},
                {data: 'action'},
            ]
        });


        function downloadFile(id) {
            window.location.href = '/admin/upload/download/' + id;
        }
        
        function deleteFile(id) {
            $('#delete-upload-id').val(id);
            $('#delete-form').submit();
        }
    </script>
@endsection