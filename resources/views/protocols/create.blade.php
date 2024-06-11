@extends('layout')

@section('content')
    <section id="hero" class="position-relative overflow-hidden py-4">

        <div class="container py-5 mt-5">

            <!-- NEW PROTOCOL -->
            <div id="new_protocol_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-12 mb-5 mb-md-0" id="protocolContainer">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ $message }}
                            <div class="row">
                                <div class="col mb-3 pull-left">
                                    <a href="{{ route('protocols.download', $invitation->inv_key) }}"
                                        class="btn btn-primary">
                                        <i class="fa fa-file" aria-hidden="true"></i> Изтегли протокол (DOCX)
                                    </a>
                                </div>
                                <div class="col mb-3 pull-right">
                                    <a href="{{ route('protocols.download_pdf', $invitation->inv_key) }}"
                                        class="btn btn-primary">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Изтегли протокол (PDF)
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endif

                    <!-- Show errors if any -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('protocols.store') }}" id="protocolForm" method="post" class="hero-form p-5">
                        @csrf
                        <h3>ПРОТОКОЛ</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_time" class="form-label mb-0">Краен час</label>
                                    <input type="text" class="form-control bs-timepicker" tabindex="2"
                                           value="{{ old('end_time') }}" name="end_time" id="end_time">
                                </div>
                                <div class="mb-3">
                                    <label for="minuteman" class="form-label mb-0">Протоколчик</label>
                                    <input type="text" class="form-control" tabindex="3"
                                           value="{{ old('minuteman') }}" name="minuteman" id="minuteman">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="meetQuorum1" class="form-label mb-0">Кворум час 1 (%)</label>
                                    <input type="number" class="form-control" tabindex="4"
                                           value="{{ old('meetQuorum1') }}" name="meetQuorum1" id="meetQuorum1">
                                </div>
                                <div class="mb-3">
                                    <label for="meetQuorum2" class="form-label mb-0">Кворум час 2 (%)</label>
                                    <input type="number" class="form-control" tabindex="5"
                                           value="{{ old('meetQuorum2') }}" name="meetQuorum2" id="meetQuorum2">
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" name="inv_key"  id="inv_key" value="{{ $invitation->inv_key }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="notes" class="form-label mb-0">Приложения</label>
                                    <textarea class="form-control" tabindex="5" rows="6" name="notes" id="notes">
                                        {{ old('notes') }}
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-3">Дневен ред</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="agendasTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ТОЧКА ОТ ДНЕВЕН РЕД</th>
                                            <th>Гласувал</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($agendas as $agenda)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $agenda['name']}}</td>
                                            <td>
                                                <table class="table table-responsive" id="agendasPoints">
                                                    <tr data-agenda-id="{{ $agenda['id'] }}">
                                                        <td class="cell1">
                                                            Зa <input type="number" name="{{ $agenda['id'] }}-approves"  class="form-control">
                                                        </td>
                                                        <td class="cell2">
                                                            Против <input type="number" name="{{ $agenda['id'] }}-refuses" class="form-control">
                                                        </td>
                                                        <td class="total">
                                                            Въздържал се
                                                            <input type="number" name="{{ $agenda['id'] }}-abstain" class="form-control" >
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-grid mt-5">
                                <button type="submit" id="protocolCreateBtn"
                                        class="btn btn-primary btn-lg">
                                    Създай протокол
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>

    <script>
        $(document).ready(function(){
            // Timepicker
            if ($('.bs-timepicker')) {
                $('.bs-timepicker').timepicker();
            };
        });
    </script>
@endsection
