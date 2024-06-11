@extends('layout')
@section('pageTitle', 'Покана за ОС')

@section('content')

    <section id="hero" class="position-relative overflow-hidden py-4">
        <div class="container py-5 mt-5">
            <div id="invitation_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-8 offset-2 p-5" style="background: rgba(255, 255, 255, 0.90)">
                    @if($invitation)
                        <h4>Покана</h4>
                        <div class="row">
                            <div class="col mt-3 mb-3 pull-left">
                                <a href="{{ route('invitations.download', $invitation->inv_key) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-file" aria-hidden="true"></i> Изтегли покана (DOCX)
                                </a>
                            </div>
                            <div class="col mt-3 mb-3 pull-right">
                                <a href="{{ route('invitations.download_pdf', $invitation->inv_key) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Изтегли покана (PDF)
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <a href="{{ route('protocols.display', $invitation->inv_key) }}"
                                    class="btn btn-secondary">
                                    Протокол
                                </a>
                            </div>
                        </div>
                    @else
                        Не е намерена покана с този ключ.
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
