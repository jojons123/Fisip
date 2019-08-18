@extends('layouts.mahasiswa')

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
            <p>Profile Mahasiwa</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <form action="{{ route('update-profile') }}" method="post">
                    @csrf
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" id="" type="text" name="name" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Email address</label>
                                    <input class="form-control" id="" type="email" name="email"
                                           value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="">NIM</label>
                                    <input class="form-control" id="" type="text" name="nim"
                                           value="{{ $mahasiswa->nim }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor HP</label>
                                    <input class="form-control" id="" type="number" name="no_hp"
                                           value="{{ $mahasiswa->no_hp }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Ganti Password</label>
                                    <input class="form-control" id="" type="password" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Universitas</label>
                                    <input class="form-control" id="" type="text" name="universitas"
                                           value="{{ $mahasiswa->universitas }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Fakultas</label>
                                    <input class="form-control" id="" type="text" name="fakultas"
                                           value="{{ $mahasiswa->fakultas }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Program Studi</label>
                                    <input class="form-control" id="" type="text" name="prodi"
                                           value="{{ $mahasiswa->prodi }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Semester</label>
                                    <input class="form-control" id="" type="number" name="semester"
                                           value="{{ $mahasiswa->semester }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" id="" type="text" name="alamat"
                                           value="{{ $mahasiswa->alamat }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection