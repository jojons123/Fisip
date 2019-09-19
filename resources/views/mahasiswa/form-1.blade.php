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
            <p>Formulir 1</p>
        </div>
        <button class="btn btn-primary" id="save-print">Simpan dan Cetak</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('update-form1') }}" method="post" id="form">
                @csrf
                <input type="hidden" name="print" value="0" id="print">
                @foreach($sections as $section)
                    @if($section->visible == 0)
                        @continue
                    @endif
                    <div class="tile">
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($section->questions as $question)
                                        @if($question->type == "text")
                                            <div class="form-group">
                                                <label for="">{!! $question->question !!}</label>
                                                <input class="form-control" id="" type="text"
                                                       name="{{ $question->slug }}"
                                                       value="{{ !is_null($answers->where('id_question', $question->id)->first()) ? $answers->where('id_question', $question->id)->first()->answer : '' }}">
                                            </div>
                                        @elseif($question->type == "textarea")
                                            <div class="form-group">
                                                <label for="">{!! $question->question !!}</label>
                                                <textarea class="form-control" id="input-q-{{ $question->id }}"
                                                          name="{{ $question->slug }}"
                                                          rows="3">{{ !is_null($answers->where('id_question', $question->id)->first()) ? $answers->where('id_question', $question->id)->first()->answer : '' }}</textarea>
                                            </div>
                                        @elseif($question->type == "radio")
                                            {!! $question->question !!}
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" id="input-q-{{ $question->id }}"
                                                               type="radio" name="{{ $question->slug }}"
                                                               value="1" {{ !is_null($answers->where('id_question', $question->id)->first()) ? ($answers->where('id_question', $question->id)->first()->answer == 1 ? 'checked' : '') : '' }}>
                                                        Ya
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" id="input-q-{{ $question->id }}"
                                                               type="radio" name="{{ $question->slug }}"
                                                               value="0" {{ !is_null($answers->where('id_question', $question->id)->first()) ? ($answers->where('id_question', $question->id)->first()->answer == 0 ? 'checked' : '') : '' }}>
                                                        Tidak
                                                    </label>
                                                </div>
                                            </div>
                                        @elseif($question->type == "multiradio")
                                            <div class="form-group">
                                                {!! $question->question !!}
                                                @foreach(${$question->prop} as $index => $property)
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input"
                                                                   id="input-q-{{ $question->id }}"
                                                                   type="radio" name="{{ $question->slug }}"
                                                                   value="{{ $property }}" {{ !is_null($answers->where('id_question', $question->id)->first()) ? ($answers->where('id_question', $question->id)->first()->answer == $property ? 'checked' : '') : '' }}>
                                                            {{ $property }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input"
                                                               id="input-q-{{ $question->id }}"
                                                               type="radio" name="{{ $question->slug }}"
                                                               value="">
                                                        Lain - lain
                                                    </label>
                                                    <input class="form-control" id="" type="text" name="{{ $question->slug }}" value="">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#save-print').on('click', function(){
            $('#print').val(1);
            $('#form').submit();
        })
    </script>
@endsection