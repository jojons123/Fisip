@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h3>Form Etika Penelitian</h3>
                            <h1>Pascasarjana Fisip
                              Magister Ilmu Administrasi</h1>
                            <!-- <p>Kepada seluruh mahasiswa dan dosen Pascasarjana Magister Ilmu Administrasi
                               Fakultas Ilmu Sosial dan Ilmu Politik Universitas Jember
                              sebagaimana untuk bersama-sama membangun serta meningkatkan kualitas pendidikan
                              Pascasarjana Magister Ilmu Administrasi Fakultas Ilmu Sosial dan Ilmu Politik Universitas Jember wajib melakukan pengisian Borang.........</p> -->
                            <a href="/form" class="btn_1">Form</a>
                            <a href="/about" class="btn_2">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
