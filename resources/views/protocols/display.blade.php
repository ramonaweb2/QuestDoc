@extends('layout')
@section('pageTitle', 'Протокол за ОС')

@section('content')

    <section id="hero" class="position-relative overflow-hidden py-4">
        <div class="container py-5 mt-5">
            <div id="invitation_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-8 offset-2 p-5" style="background: rgba(255, 255, 255, 0.90)">
                    <h4 class="d-inline-block">Протокол</h4>
                    <a href="{{ route('protocols.show_voting', $invitation->inv_key) }}" class="ms-3">
                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                        Гласуване на дневен ред
                    </a>
                    <a href="{{ route('protocols.edit', $invitation->inv_key) }}" class="pull-right">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Редактирай
                    </a>
                    <div class="row">
                        <div class="col mt-3 mb-3 pull-left">
                            <a href="{{ route('protocols.download', $invitation->inv_key) }}"
                                class="btn btn-primary">
                                <i class="fa fa-file" aria-hidden="true"></i> Изтегли протокол (DOCX)
                            </a>
                        </div>
                        <div class="col mt-3 mb-3 pull-right">
                            <a href="{{ route('protocols.download_pdf', $invitation->inv_key) }}"
                                class="btn btn-primary">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Изтегли протокол (PDF)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
