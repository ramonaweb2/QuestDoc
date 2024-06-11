@extends('layout')
@section('pageTitle', 'Старо събрание')

@section('content')

    <section id="hero" class="position-relative overflow-hidden py-4">

        <div class="container py-5 mt-5">
            <div id="select_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-5 offset-md-1 p-5" style="background: rgba(255, 255, 255, 0.90)">
                    <form action="{{ route('invitations.display') }}" id="meetForm" method="get" class="hero-form p-5">
                        @csrf
                        <h4>ВЪВЕДЕТЕ КОД НА ПОКАНА</h4>

                        <div class="mb-4">
                            <label for="inv_key" class="form-label mb-0">Код</label>
                            <input type="text" class="form-control" autofocus name="inv_key" id="inv_key">
                        </div>
                        <div class="d-grid">
                            <button type="submit" id="meetShowBtn" class="btn btn-primary btn-lg">Въведи</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
