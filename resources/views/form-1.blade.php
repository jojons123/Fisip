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
                        <h2>Etika Penelitian</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <form id="regForm" action="/form-1" method="post" onsubmit="submitValidation()">
                        @csrf
                        <!-- One "tab" for each step in the form: -->
                            @foreach($sections as $section)
                                @if($section->visible == 0)
                                    @continue
                                @endif
                                <div class="tab" data-section="{{ $section->id }}">

                                    @if(!is_null($section->parent_id))
                                        <h3 style="text-align: center">{!! \App\Section::find($section->parent_id)->name !!}</h3>
                                        <h4 style="text-align: center">{!! $section->name !!}</h4>
                                    @else
                                        <h3 style="text-align: center">{!! $section->name !!}</h3>
                                    @endif
                                    @if(!is_null($section->description))
                                        <p style="text-align: justify;">{!! $section->description !!}</p>
                                    @endif

                                    @foreach($section->questions as $question)
                                        <div class="mt-10" id="input-q-{{$question->id}}">
                                            {!! $question->question !!}
                                            @if($question->type == "text")
                                                <input type="text" name="{{ $question->slug }}"
                                                       placeholder="{{ $question->placeholder }}"
                                                       onfocus="this.placeholder = ''"
                                                       onblur="this.placeholder = '{{ $question->placeholder }}'"
                                                       class="single-input">
                                            @elseif($question->type == "radio")
                                                <div class="col-md3">
                                                    <div class="switch-wrap d-flex justify-content-between">
                                                        <label for="radio-{{ $question->id}}-1" class="clickable">
                                                            <p>1.
                                                                Ya</p></label>
                                                        <div class="primary-radio">
                                                            <input type="radio" id="radio-{{ $question->id}}-1"
                                                                   name="{{ $question->slug }}"
                                                                   value="1">
                                                            <label for="radio-{{ $question->id}}-1"></label>
                                                        </div>
                                                    </div>
                                                    <div class="switch-wrap d-flex justify-content-between">
                                                        <label for="radio-{{ $question->id}}-2" class="clickable">
                                                            <p>2.
                                                                Tidak</p></label>
                                                        <div class="primary-radio">
                                                            <input type="radio" id="radio-{{ $question->id}}-2"
                                                                   name="{{ $question->slug }}"
                                                                   value="0">
                                                            <label for="radio-{{ $question->id}}-2"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif($question->type == "multiradio")
                                                <div class="col-md3">
                                                    @foreach(${$question->prop} as $index => $property)
                                                        <div class="switch-wrap d-flex justify-content-between">
                                                            <label for="radio-{{ $question->id}}-{{ $index+1 }}" class="clickable">
                                                                <p>{{ $property }}</p></label>
                                                            <div class="primary-radio">
                                                                <input type="radio" id="radio-{{ $question->id}}-{{ $index+1 }}"
                                                                       name="{{ $question->slug }}"
                                                                       value="{{ $property }}">
                                                                <label for="radio-{{ $question->id}}-{{ $index+1 }}"></label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="switch-wrap d-flex justify-content-between">
                                                        <label for="radio-{{ $question->id}}-{{ count(${$question->prop}) + 1 }}" class="clickable">
                                                            <p>Lain - lain</p></label>
                                                        <div class="primary-radio">
                                                            <input type="radio" id="radio-{{ $question->id}}-{{ count(${$question->prop}) + 1 }}"
                                                                   name="{{ $question->slug }}"
                                                                   value="etc">
                                                            <label for="radio-{{ $question->id}}-{{ count(${$question->prop}) + 1 }}"></label>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="{{ $question->slug }}_etc"
                                                           placeholder="Masukan sumber dana"
                                                           class="single-input">
                                                </div>
                                            @elseif($question->type == "date")
                                                <input type="date" name="{{ $question->slug }}" required
                                                       class="single-input"
                                                       placeholder="">

                                            @elseif($question->type == "number")
                                                <input type="number" name="{{ $question->slug }}" min="0" required
                                                       class="single-input" placeholder="{{ $question->placeholder }}">

                                            @elseif($question->type == "multitext")
                                                <div class="multiple-val" id="{{ $question->id }}">
                                                    @php($count = (int) $question->prop)
                                                    @for($i = 0; $i < $count; $i++)
                                                        <div class="mt-10">
                                                            <input type="text" name="mata_kuliah_belum_lulus[]"
                                                                   placeholder="Mata Kuliah / SKS"
                                                                   onfocus="this.placeholder = ''"
                                                                   onblur="this.placeholder = 'Mata Kuliah / SKS'"
                                                                   class="single-input">
                                                        </div>
                                                    @endfor
                                                </div>

                                            @elseif($question->type == "textarea")
                                                <textarea class="single-textarea"
                                                          placeholder="{{ $question->placeholder }}"
                                                          name="{{ $question->slug }}"
                                                          onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''"
                                                          onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = '{{ $question->placeholder }}'"></textarea>

                                            @elseif($question->type == "checkbox")
                                                @foreach($mata_kuliahs as $mk)
                                                    <p>
                                                        <input type="checkbox" id="cb-{{ $mk->id }}"
                                                               name="{{ $question->slug }}" value="{{ $mk->id }}">
                                                        <label for="cb-{{ $mk->id }}">{{ $mk->mata_kuliah }}
                                                            / {{ $mk->sks }} SKS</label>
                                                    </p>
                                                @endforeach
                                            @elseif($question->type == "scale")
                                                <br>
                                                <br>
                                                <div class="col-md-12 cust-rad">
                                                    <ul>
                                                        <li><input type="radio" name="{{ $question->slug }}" value="1"
                                                                   id="radio-{{ $question->id}}-1"><label
                                                                    for="radio-{{ $question->id}}-1">1</label></li>
                                                        <li><input type="radio" name="{{ $question->slug }}" value="2"
                                                                   id="radio-{{ $question->id}}-2"><label
                                                                    for="radio-{{ $question->id}}-2">2</label></li>
                                                        <li><input type="radio" name="{{ $question->slug }}" value="3"
                                                                   id="radio-{{ $question->id}}-3"><label
                                                                    for="radio-{{ $question->id}}-3">3</label></li>
                                                        <li><input type="radio" name="{{ $question->slug }}" value="4"
                                                                   id="radio-{{ $question->id}}-4"><label
                                                                    for="radio-{{ $question->id}}-4">4</label></li>
                                                        <li><input type="radio" name="{{ $question->slug }}" value="5"
                                                                   id="radio-{{ $question->id}}-5"><label
                                                                    for="radio-{{ $question->id}}-5">5</label></li>
                                                    </ul>
                                                </div>
                                                <br>
                                                <br>
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            @endforeach

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
                                @foreach($sections as $section)
                                    @if($section->visible == 0)
                                        @continue
                                    @endif
                                    <span class="step"></span>
                                @endforeach
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
            $('#input-q-49').hide();
            $('#input-q-50').hide();
            $('#input-q-51').hide();
            $('#input-q-52').hide();
            $('#input-q-53').hide();
            $('#input-q-54').hide();
            $('#input-q-55').hide();
            $('#input-q-56').hide();
        });


        function showHideRadioButton(question, destination) {
            $('#input-q-' + question + ' input:radio').each(function () {
                if ($(this).on('change', function () {
                    if ($('#radio-' + question + '-1').is(':checked')) {
                        $('#input-q-' + destination).show();
                    } else {
                        $('#input-q-' + destination).hide();
                    }
                })) ;
            });
        }


        function showHideRadioButtonFalse(question, destination) {
            $('#input-q-' + question + ' input:radio').each(function () {
                if ($(this).on('change', function () {
                    if ($('#radio-' + question + '-2').is(':checked')) {
                        $('#input-q-' + destination).show();
                    } else {
                        $('#input-q-' + destination).hide();
                    }
                })) ;
            });
        }

        showHideRadioButton(48, 49);
        showHideRadioButtonFalse(48, 50);
        showHideRadioButton(50, 51);
        showHideRadioButton(50, 52);
        showHideRadioButton(50, 53);
        showHideRadioButton(50, 54);
        showHideRadioButton(50, 55);
        showHideRadioButton(50, 56);

        function submitValidation() {
            $('#regForm').find('div:hidden').each(function () {
                $(this).find('input').prop('checked', false);
            });
        }
    </script>
@endsection

