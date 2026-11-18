<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarEventoRequest;
use App\Http\Requests\NovaPerguntaRequest;
use App\Models\Evento;
use App\Models\Pergunta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventoController extends Controller
{
    public function listar(): View
    {
        $listaEventos = Evento::withCount('perguntas')->latest()->get();

        return view('eventos.index', [
            'eventos' => $listaEventos,
        ]);
    }

    public function exibir(int|string $id): View
    {
        $eventoAtual = Evento::findOrFail($id);

        $listaPerguntas = $eventoAtual->perguntas()
            ->latest()
            ->paginate(10);

        return view('eventos.show', [
            'evento'    => $eventoAtual,
            'perguntas' => $listaPerguntas,
        ]);
    }

    public function cadastrar(): View
    {
        return view('eventos.create');
    }

    public function salvar(CriarEventoRequest $requisicao): RedirectResponse
    {
        $novoEvento = $requisicao->user()->eventos()->create($requisicao->validated());

        return redirect()
            ->route('eventos.show', $novoEvento->id)
            ->with('sucesso', 'Evento cadastrado com sucesso!');
    }

    public function registrarPergunta(NovaPerguntaRequest $requisicao, int|string $id): RedirectResponse
    {
        $eventoAtual = Evento::findOrFail($id);

        Pergunta::create([
            'evento_id' => $eventoAtual->id,
            'user_id'   => Auth::id(),
            'texto'     => $requisicao->input('texto'),
            'status'    => 'pendente',
        ]);

        return redirect()
            ->route('eventos.show', $eventoAtual->id)
            ->with('sucesso', 'Sua pergunta foi enviada com sucesso!');
    }
}
