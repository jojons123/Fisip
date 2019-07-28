@extends('layouts.app')

@section('title', 'Home')

@section('css')

    <style>
        .content-center {
            text-align: center;
        }

        .file-input{

        }

        /* Hide HTML5 Up and Down arrows. */
        input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <section class="testimonial_part section_padding">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <h2>Upload Scan Form</h2>
                    </div>
                    <div class="text-center">
                        <p>Masukan nama dan nim sesuai dengan yang diinputkan saat mengisi formulir</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mt-10">
                                NIM :
                                <input type="number" name="nim" required class="single-input">
                            </div>

                            <div class="mt-10">
                                Nama :
                                <input type="text" name="nama" required class="single-input">
                            </div>
                            <br>

                            <div class="mt-10">
                                File : <br>
                                <input type="file" name="file" required class="file-input">
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm btn_1">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
