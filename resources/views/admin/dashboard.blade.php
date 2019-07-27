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
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Dosen Pembimbing</th>
                            <th>Tahun Masuk</th>
                            <th>Jenjang Studi</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $('#mahasiswa-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ url('ajax/mahasiswa') }}',
            createdRow: function (row, data, index) {
                $(row).addClass('clickable-row');
                $(row).attr('data-href', "/admin/mahasiswa/" + data["id"]);
            },
            columns: [
                {data: 'no'},
                {data: 'nama'},
                {data: 'nim'},
                {data: 'dosen_pembimbing_utama'},
                {data: 'tahun_masuk'},
                {data: 'jenjang_studi'},
            ],
            drawCallback: function(s, j){
                $(".clickable-row").click(function () {
                    window.location = $(this).data("href");
                });
            }
        });


    </script>
@endsection