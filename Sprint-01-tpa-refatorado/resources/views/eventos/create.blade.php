@extends('layouts.app')

@section('title', 'Novo Evento — FalaQ')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm p-4">
            <h4 class="fw-bold mb-3">📅 Cadastrar Novo Evento</h4>
            <form action="{{ route('eventos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label text-secondary">Título do Evento</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                           class="form-control bg-dark text-white border-secondary @error('titulo') is-invalid @enderror">
                    @error('titulo')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label text-secondary">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="3"
                              class="form-control bg-dark text-white border-secondary @error('descricao') is-invalid @enderror">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="data_evento" class="form-label text-secondary">Data do Evento</label>
                    <input type="date" name="data_evento" id="data_evento" value="{{ old('data_evento') }}"
                           class="form-control bg-dark text-white border-secondary @error('data_evento') is-invalid @enderror">
                    @error('data_evento')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary w-50">Voltar</a>
                    <button type="submit" class="btn btn-primary w-50 fw-bold">Salvar Evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
