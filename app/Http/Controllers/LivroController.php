<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::all();
        $livros = $livros->map(function ($livro) {
            $livro->dt_inclusao = (new \DateTime($livro->dt_inclusao))->format('d/m/Y');
            $livro->dt_alteracao = (new \DateTime($livro->dt_alteracao))->format('d/m/Y');
            return $livro;
        });

        if (request()->wantsJson()) {
            return response()->json($livros);
        }

        return Inertia::render('Livros', ['livros' => $livros]);
    }

    public function create()
    {
        return Inertia::render('Livros');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome_livro' => 'required|unique:livros',
            ]);

            $now = now();

            DB::table('livros')->insert([
                'nome_livro' => $request->input('nome_livro'),
                'dt_inclusao' => $now,
                'dt_alteracao' => $now,
            ]);

            return response()->json(['message' => 'Livro cadastrado com sucesso'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar o livro. Não é possível ter livros com nomes iguais.'], 500);
        }
    }

    public function show($livro_id)
    {
        $livro = Livro::findOrFail($livro_id);
        return Inertia::render('Livros/Show', ['livro' => $livro]);
    }

    public function edit($livro_id)
    {
        $livro = Livro::findOrFail($livro_id);
        return Inertia::render('Livros/Edit', ['livro' => $livro]);
    }

    public function update(Request $request, $livro_id)
    {
        try {
            $livro = Livro::findOrFail($livro_id);

            $request->validate([
                'nome_livro' => 'required',
            ]);

            $now = now();

            DB::table('livros')->where('livro_id', $livro_id)->update([
                'nome_livro' => $request->input('nome_livro'),
                'dt_alteracao' => $now,
            ]);

            return response()->json(['message' => 'Usuário atualizado com sucesso', 'livro' => $livro], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o usuário: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($livro_id)
    {
        try {
            $livro = Livro::findOrFail($livro_id);
            $livro->delete();

            return response()->json(['message' => 'Usuário removido com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
