@extends('layouts.app')

@section('title', 'Eventos — FalaQ')

@section('navbar_item')
    @auth
        <a href="{{ route('eventos.create') }}" class="btn btn-outline-light btn-sm">+ Novo Evento</a>
    @endauth
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2 class="fw-bold">📅 Eventos Disponíveis</h2>
        <p class="text-muted">Escolha um evento abaixo para acompanhar e enviar suas perguntas.</p>
    </div>

    @foreach($eventos as $itemEvento)
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h4 class="card-title fw-bold text-white">{{ $itemEvento->titulo }}</h4>
                    <p class="card-text text-secondary">{{ $itemEvento->descricao }}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="badge" style="background:#7c6af7;">
                        {{ $itemEvento->perguntas_count ?? $itemEvento->perguntas->count() }} perguntas
                    </span>
                    <a href="{{ route('eventos.show', $itemEvento->id) }}" class="btn btn-primary btn-sm">
                        Acessar Evento &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
