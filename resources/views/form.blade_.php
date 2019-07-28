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
                        <h2>Kemajuan Studi</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <form id="regForm" action="/">
                            <!-- One "tab" for each step in the form: -->
                            <div class="tab">
                                <h4 style="text-align: center">BORANG LAPORAN INTERIM KEMAJUAN STUDI DAN PENELITIAN MAHASISWA PASCASARJANA MIA FISIP UNEJ</h4>
                                <div class="mt-10">
                                    Nama :
                                    <input type="text" name="nama" required class="single-input">
                                </div>

                                <div class="mt-10">
                                    NIM :
                                    <input type="number" name="nim" min="0" required class="single-input">
                                </div>

                                <div class="mt-10">
                                    Dosen Pembimbing Utama :
                                    <input type="text" name="dosen_pembimbing_utama" required class="single-input">
                                </div>

                                <div class="multiple-val">
                                    Dosen Pembimbing Anggota :
                                    <div class="mt-10">
                                        <input type="text" name="dosen_pembimbing_anggota[]"
                                               placeholder="Dosen Pembimbing Anggota 1"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Dosen Pembimbing Anggota 1'"
                                               class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="text" name="dosen_pembimbing_anggota[]"
                                               placeholder="Dosen Pembimbing Anggota 2"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Dosen Pembimbing Anggota 2'"
                                               class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="text" name="dosen_pembimbing_anggota[]"
                                               placeholder="Dosen Pembimbing Anggota 3"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Dosen Pembimbing Anggota 3'"
                                               class="single-input">
                                    </div>
                                </div>

                                <div class="mt-10">
                                    Periode Maximum Waktu Studi :
                                    <input type="text" disabled class="single-input"
                                           value="2 Tahun (Magister Ilmu Administrasi)">
                                </div>

                                <div class="mt-10">
                                    Tahun Masuk :
                                    <input type="number" name="tahun_masuk" required class="single-input">
                                </div>

                                <div class="mt-10">
                                    Jenjang Studi :
                                    <input type="number" name="jenjang_studi" required class="single-input">
                                </div>

                                <div class="mt-10">
                                    Komitmen waktu Pelaksanaan Studi dan Penelitian perminggu (jam/minggu) :
                                    <input type="number" name="waktu_pelaksanaan" required class="single-input"
                                           placeholder="">
                                </div>
                                <div class="mt-10">
                                    Waktu Selesai studi yang diharapkan:
                                    <input type="date" name="waktu_selesai_studi" required class="single-input"
                                           placeholder="">
                                </div>
                                <div class="mt-10" id="radio-q-1">
                                    Apakah anda telah melampaui periode Maximum Waktu Studi?
                                    <div class="col-md3">
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-1-1" class="clickable"><p>1. Ya</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-1-1" name="melampaui_max_waktu_studi"
                                                       value="1">
                                                <label for="radio-1-1"></label>
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-1-2" class="clickable"><p>2. Tidak</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-1-2" name="melampaui_max_waktu_studi"
                                                       value="0">
                                                <label for="radio-1-2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-10" id="radio-q-2">
                                    Jika Ya, apakah dibutuhkan perpanjangan studi?
                                    <div class="col-md3">
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-2-1" class="clickable"><p>1. Ya</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-2-1" name="perpanjangan_studi" value="1">
                                                <label for="radio-2-1"></label>
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-2-2" class="clickable"><p>2. Tidak</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-2-2" name="perpanjangan_studi" value="0">
                                                <label for="radio-2-2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-10" id="radio-q-3">
                                    Jika Ya,Apakah Perpanjangan Studi anda sudah disetujui atau diketahui oleh
                                    Kaprodi/Wakil Dekan?
                                    <div class="col-md3">
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-3-1" class="clickable"><p>1. Ya</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-3-1" name="persetujuan_perpanjangan_studi"
                                                       value="1">
                                                <label for="radio-3-1"></label>
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-3-2" class="clickable"><p>2. Tidak</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-3-2" name="persetujuan_perpanjangan_studi"
                                                       value="0">
                                                <label for="radio-3-2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-10" id="radio-q-4">
                                    Alasan Perpanjangan Studi :
                                    <input type="text" class="single-input" name="alasan_perpanjangan_studi">
                                </div>

                                {{--<div class="mt-10" id="radio-q-3">--}}
                                {{--Jika Ya, apakah dibutuhkan perpanjangan studi?--}}
                                {{--<div class="col-md3">--}}
                                {{--<div class="switch-wrap d-flex justify-content-between">--}}
                                {{--<label for="radio-2-1" class="clickable"><p>1. Ya</p></label>--}}
                                {{--<div class="primary-radio">--}}
                                {{--<input type="radio" id="radio-2-1" name="perpanjangan_studi" value="1">--}}
                                {{--<label for="radio-2-1"></label>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="switch-wrap d-flex justify-content-between">--}}
                                {{--<label for="radio-2-2" class="clickable"><p>2. Tidak</p></label>--}}
                                {{--<div class="primary-radio">--}}
                                {{--<input type="radio" id="radio-2-2" name="perpanjangan_studi" value="0">--}}
                                {{--<label for="radio-2-2"></label>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}


                            </div>
                            <div class="tab">
                                <h4 style="text-align: center">LAPORAN Interim KEMAJUAN STUDI dan Peneltian MAHASISWA PASCASARJANA MIA FISIP UNEJ</h4>
                                <div class="mt-10" id="radio-q-5">
                                    <b>Apakah studi perkuliahan anda berjalan sesuai dengan rencana studi?</b> (jika tidak, tolong  sebutkan berapa SKS perkuliahan yang belum ditempuh/ lulus beserta mata kuliahnya serta jelaskan pada kolom kelima dibawah)
                                    <div class="col-md3">
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-5-1" class="clickable"><p>1. Ya</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-5-1" name="melampaui_max_waktu_studi"
                                                       value="1">
                                                <label for="radio-5-1"></label>
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-5-2" class="clickable"><p>2. Tidak</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-5-2" name="melampaui_max_waktu_studi"
                                                       value="0">
                                                <label for="radio-5-2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="multiple-val" id="radio-q-6">
                                    Sebutkan Mata kuliah dan jumlah SKS yang sudah belum ditempuh/ belum lulus :
                                    <div class="mt-10">
                                        <input type="text" name="mata_kuliah_belum_lulus[]"
                                               placeholder="Mata Kuliah / SKS"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Mata Kuliah / SKS'"
                                               class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="text" name="mata_kuliah_belum_lulus[]"
                                               placeholder="Mata Kuliah / SKS"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Mata Kuliah / SKS'"
                                               class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="text" name="mata_kuliah_belum_lulus[]"
                                               placeholder="Mata Kuliah / SKS"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Mata Kuliah / SKS'"
                                               class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="text" name="mata_kuliah_belum_lulus[]"
                                               placeholder="Mata Kuliah / SKS"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Mata Kuliah / SKS'"
                                               class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="text" name="mata_kuliah_belum_lulus[]"
                                               placeholder="Mata Kuliah / SKS"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Mata Kuliah / SKS'"
                                               class="single-input">
                                    </div>
                                </div>

                                <div class="mt-10" id="radio-q-7">
                                    <b>Apakah waktu studi yang anda harapkan membutuhkan perubahan tanggal ?</b> ( Jika Iya, silahkan hubungi Bagian Akademik Pascasrajana FISIP UNEJ untuk persyaratan.)
                                    <div class="col-md3">
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-7-1" class="clickable"><p>1. Ya</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-7-1" name="membutuhkan_perubahan_tanggal"
                                                       value="1">
                                                <label for="radio-7-1"></label>
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-7-2" class="clickable"><p>2. Tidak</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-7-2" name="membutuhkan_perubahan_tanggal"
                                                       value="0">
                                                <label for="radio-7-2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-10" id="radio-q-8">
                                    <b>Apakah terdapat daya dukung fasilitas yang cukup dalam penyelesaian riset saudara (termasuk akses pada literatur yang relevant)?</b> (jika tidak, tolong jelaskan pada kolom kelima dibawah)
                                    <div class="col-md3">
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-8-1" class="clickable"><p>1. Ya</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-8-1" name="dukungan_fasilitas_dalam_riset"
                                                       value="1">
                                                <label for="radio-8-1"></label>
                                            </div>
                                        </div>
                                        <div class="switch-wrap d-flex justify-content-between">
                                            <label for="radio-8-2" class="clickable"><p>2. Tidak</p></label>
                                            <div class="primary-radio">
                                                <input type="radio" id="radio-8-2" name="dukungan_fasilitas_dalam_riset"
                                                       value="0">
                                                <label for="radio-8-2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-10" id="radio-q-9">
                                    Apakah Proses studi  anda berjalan sesuai dengan kemajuan yang anda harapakan? Jika Tidak, tolong paparkan beberapa hal yang menurut anda yang bisa dan mampu untuk mencapai kemajuan yang diharapkan dalam studi anda :
                                    <input type="text" class="single-input" name="alasan_perpanjangan_studi">
                                </div>

                            </div>


                            <div class="tab">Birthday:
                                <p><input oninput="this.className = ''" name="dd"></p>
                                <p><input oninput="this.className = ''" name="nn"></p>
                                <p><input oninput="this.className = ''" name="yyyy"></p>
                            </div>
                            <div class="tab">Login Info:
                                <p><input oninput="this.className = ''" name="uname"></p>
                                <p><input oninput="this.className = ''" name="pword"
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
    <script>

        $(document).ready(function () {
            $('#radio-q-2').hide();
            $('#radio-q-3').hide();
            $('#radio-q-4').hide();
            $('#radio-q-6').hide();
        });


        function showHideRadioButton(question, destination) {
            $('#radio-q-' + question + ' input:radio').each(function () {
                if ($(this).on('change', function () {
                    if ($('#radio-' + question + '-1').is(':checked')) {
                        $('#radio-q-' + destination).show();
                    } else {
                        $('#radio-q-' + destination).hide();
                    }
                    // if ($('#radio-' + question + '-2').is(':checked')) {
                    //     $('#radio-q-' + destination).hide();
                    // }
                })) ;
            });
        }


        function showHideRadioButtonFalse(question, destination) {
            $('#radio-q-' + question + ' input:radio').each(function () {
                if ($(this).on('change', function () {
                    if ($('#radio-' + question + '-2').is(':checked')) {
                        $('#radio-q-' + destination).show();
                    } else {
                        $('#radio-q-' + destination).hide();
                    }
                    // if ($('#radio-' + question + '-2').is(':checked')) {
                    //     $('#radio-q-' + destination).hide();
                    // }
                })) ;
            });
        }

        showHideRadioButton(1,2);
        showHideRadioButton(2,3);
        showHideRadioButton(2,4);
        showHideRadioButtonFalse(5, 6);

        // $('#radio-q-1 input:radio').each(function () {
        //     if ($(this).on('change', function () {
        //         if ($('#radio-1-1').is(':checked')) {
        //             $('#radio-q-2').show();
        //         } else {
        //             $('#radio-q-2').hide();
        //         }
        //     })) ;
        // });
    </script>
@endsection
