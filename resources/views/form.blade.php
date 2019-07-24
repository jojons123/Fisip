@extends('layouts.app')

@section('title', 'Form')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form-wizard.css') }}">
@endsection

@section('content')
    <section class="testimonial_part section_padding">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <p>Form</p>
                        <h2>Kesejahteraan Sosial</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <form id="regForm" action="/">
                            <!-- One "tab" for each step in the form: -->
                            <div class="tab">
                                <div class="mt-10">
                                    Nama :
                                    <input type="text" name="nama"  required class="single-input">
                                </div>

                                <div class="mt-10">
                                    NIM :
                                    <input type="number" name="nim"  min="0" required class="single-input">
                                </div>

                                <div class="mt-10">
                                    Dosen Pembimbing Utama :
                                    <input type="text" name="dosen_pembimbing_utama"  required class="single-input">
                                </div>

                                <div class="multiple-val">
                                    Dosen Pembimbing Anggota :
                                    <div class="mt-10">
                                        <input type="text" name="dosen_pembimbing_anggota[]" placeholder="Dosen Pembimbing Anggota 1"
                                               onfocus="this.placeholder = ''" onblur="this.placeholder = 'Dosen Pembimbing Anggota 1'"
                                               class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="text" name="dosen_pembimbing_anggota[]" placeholder="Dosen Pembimbing Anggota 2"
                                               onfocus="this.placeholder = ''" onblur="this.placeholder = 'Dosen Pembimbing Anggota 2'"
                                               class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="text" name="dosen_pembimbing_anggota[]" placeholder="Dosen Pembimbing Anggota 3"
                                               onfocus="this.placeholder = ''" onblur="this.placeholder = 'Dosen Pembimbing Anggota 3'"
                                               class="single-input">
                                    </div>
                                </div>

                                <div class="mt-10">
                                    Periode Maximum Waktu Studi :
                                    <input type="text" disabled class="single-input" value="2 Tahun (Magister Ilmu Administrasi)">
                                </div>

                                <div class="mt-10">
                                    Tahun Masuk :
                                    <input type="number" name="tahun_masuk"  required class="single-input">
                                </div>

                                <div class="mt-10">
                                    Jenjang Studi :
                                    <input type="number" name="jenjang_studi"  required class="single-input">
                                </div>

                                <div class="mt-10">
                                    Komitmen waktu Pelaksanaan Studi dan Penelitian perminggu (jam/minggu) :
                                    <input type="number" name="waktu_pelaksanaan"  required class="single-input" placeholder="">
                                </div>
                                <div class="mt-10">
                                    Waktu Selesai studi yang diharapkan:
                                    <input type="number" name="waktu_selesaiStudi"  required class="single-input" placeholder="">
                                </div>
                            </div>
                            <div class="tab">Contact Info:
                                <p><input  oninput="this.className = ''" name="email"></p>
                                <p><input  oninput="this.className = ''" name="phone"></p>
                            </div>
                            <div class="tab">Birthday:
                                <p><input  oninput="this.className = ''" name="dd"></p>
                                <p><input  oninput="this.className = ''" name="nn"></p>
                                <p><input  oninput="this.className = ''" name="yyyy"></p>
                            </div>
                            <div class="tab">Login Info:
                                <p><input  oninput="this.className = ''" name="uname"></p>
                                <p><input  oninput="this.className = ''" name="pword"
                                          type="password"></p>
                            </div>
                            <div class="wizard-btn-area">
                                <div class="wizard-btn">
                                    <button class="genric-btn primary-border circle" type="button" id="prevBtn"
                                            onclick="nextPrev(-1)">Previous
                                    </button>
                                    <button class="genric-btn primary circle" type="button" id="nextBtn"
                                            onclick="nextPrev(1)">Next
                                    </button>
                                </div>
                            </div>
                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center;margin-top:40px;">
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('js/form-wizard.js') }}"></script>
@endsection