@extends('layout')
@section('pageTitle', 'Гласуване на дневен ред')

@section('content')
    <section id="hero" class="position-relative overflow-hidden py-4">
        <div class="container py-5 mt-5">
            <div id="new_protocol_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-12 mb-5 mb-md-0" id="protocolContainer">
                    <form action="{{ route('protocols.store_voting', $invitation->inv_key) }}" id="protocolForm" method="POST" class="hero-form p-5">
                        @csrf
                        <h3>Гласуване на дневен ред</h3>

                        <div class="row">
                            <div class="col-md-12">
                                @foreach($participants as $part)
                                    <div class="fw-bold">
                                        <strong>{{ $part->apartment }}</strong>, 
                                        {{ $part->person}} 
                                        {{ $part->parts }} ид.ч.
                                    </div>
                                    <ol class="mb-5">
                                        @foreach($agendas as $agenda)
                                        <li>
                                            {{ $agenda['name']}}<br/>
                                            <div class="form-check">
                                                <label for="{{ $part->id }}-approves-{{ $agenda['id'] }}" class="form-check-label">ЗА</label>
                                                <input type="radio" id="{{ $part->id }}-approves-{{ $agenda['id'] }}" class="form-check-input"
                                                        name="{{ $part->id }}-agenda-{{ $agenda['id'] }}" 
                                                        value="approves"/>
                                            </div>
                                            <div class="form-check">
                                                <label for="{{ $part->id }}-refuses-{{ $agenda['id'] }}" class="form-check-label">ПРОТИВ</label>
                                                <input type="radio" id="{{ $part->id }}-refuses-{{ $agenda['id'] }}" class="form-check-input"
                                                        name="{{ $part->id }}-agenda-{{ $agenda['id'] }}" 
                                                        value="refuses"/>
                                            </div>
                                            <div class="form-check">
                                                <label for="{{ $part->id }}-abstain" class="form-check-label">ВЪЗДЪРЖАЛ</label>
                                                <input type="radio" id="{{ $part->id }}-abstain-{{ $agenda['id'] }}" class="form-check-input"
                                                        name="{{ $part->id }}-agenda-{{ $agenda['id'] }}"
                                                        value="abstain" />
                                            </div>
                                        </li>
                                        @endforeach
                                    </ol>
                                @endforeach

                                @if($agendas)
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
                                                                Зa <input type="number" name="{{ $agenda['id'] }}-approves"
                                                                value="{{ $agenda['approves'] }}" class="form-control">
                                                            </td>
                                                            <td class="cell2">
                                                                Против <input type="number" name="{{ $agenda['id'] }}-refuses"
                                                                value="{{ $agenda['refuses'] }}" class="form-control">
                                                            </td>
                                                            <td class="total">
                                                                Въздържал се
                                                                <input type="number" name="{{ $agenda['id'] }}-abstain"
                                                                value="{{ $agenda['abstain'] }}" class="form-control" >
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                <input type="hidden" name="meetQuorum2" id="meetQuorum2" value="{{ $meetQuorum2 }}">
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" name="protocol_id" value="{{ $protocol->id }}">
                            <div class="d-grid mt-5">
                                <button type="submit" id="protocolCreateBtn"
                                        class="btn btn-primary btn-lg">
                                    Запиши
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('input[value*="abstain"]').prop('checked', true);
        });
    </script>
@endsection