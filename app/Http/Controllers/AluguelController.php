<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluguel;
use App\Models\Livro;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AluguelController extends Controller
{
    public function index()
    {
        $livros = Livro::all();
        $usuarios = Usuario::all();
        $alugueis = Aluguel::all();
        $alugueis = $alugueis->map(function ($aluguel) {
            $aluguel->dt_aluguel_ini = (new \DateTime($aluguel->dt_aluguel_ini))->format('d/m/Y');
            $aluguel->dt_aluguel_fim = (new \DateTime($aluguel->dt_aluguel_fim))->format('d/m/Y');
            return $aluguel;
        });

        if (request()->wantsJson()) {
            return response()->json($alugueis);
        }

        return Inertia::render('Alugueis', [
            'livros' => $livros,
            'usuarios' => $usuarios,
            'alugueis' => $alugueis
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'livro_id' => 'required',
                'usuario_id' => 'required',
                'dt_aluguel_ini' => 'required|date|after_or_equal:today',
                'dt_aluguel_fim' => 'required|date|after:dt_aluguel_ini',
            ], [
                'livro_id.required' => 'O ID do livro é obrigatório.',
                'usuario_id.required' => 'O ID do usuário é obrigatório.',
                'dt_aluguel_ini.required' => 'A data de início do aluguel é obrigatória.',
                'dt_aluguel_ini.date' => 'A data de início do aluguel deve ser uma data válida.',
                'dt_aluguel_ini.after_or_equal' => 'A data de início do aluguel deve ser hoje ou depois de hoje.',
                'dt_aluguel_fim.required' => 'A data de fim do aluguel é obrigatória.',
                'dt_aluguel_fim.date' => 'A data de fim do aluguel deve ser uma data válida.',
                'dt_aluguel_fim.after' => 'A data de fim do aluguel deve ser posterior à data de início.',
            ]);

            $now = now();

            $livroDisponivel = Aluguel::where('livro_id', $request->input('livro_id'))
                ->where(function ($query) use ($request) {
                    $query->whereBetween('dt_aluguel_ini', [$request->input('dt_aluguel_ini'), $request->input('dt_aluguel_fim')])
                        ->orWhereBetween('dt_aluguel_fim', [$request->input('dt_aluguel_ini'), $request->input('dt_aluguel_fim')]);
                })->doesntExist();

            if (!$livroDisponivel) {
                return response()->json(['message' => 'Livro não disponível para aluguel nesse período'], 400);
            }

            DB::table('alugueis')->insert([
                'livro_id' => $request->input('livro_id'),
                'usuario_id' => $request->input('usuario_id'),
                'dt_aluguel_ini' => $request->input('dt_aluguel_ini'),
                'dt_aluguel_fim' => $request->input('dt_aluguel_fim'),
                'dt_inclusao' => $now,
                'dt_alteracao' => $now,
            ]);

            return response()->json(['message' => 'Locação criada com sucesso', 'aluguel'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $aluguel_id)
    {
        try {
            $aluguel = DB::table('alugueis')->where('aluguel_id', $aluguel_id)->first();

            if (!$aluguel) {
                return response()->json(['error' => 'Aluguel não encontrado'], 404);
            }

            $dadosAtualizacao = $request->only(['livro_id', 'usuario_id', 'dt_aluguel_ini', 'dt_aluguel_fim']);

            $dadosAtualizacao['dt_alteracao'] = now(); // Adiciona a data de alteração atual

            DB::table('alugueis')->where('aluguel_id', $aluguel_id)->update($dadosAtualizacao);

            return response()->json(['message' => 'Locação atualizada com sucesso', 'aluguel' => $aluguel], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar a locação: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($aluguel_id)
    {
        try {
            $aluguel = Aluguel::findOrFail($aluguel_id);
            $aluguel->delete();

            return response()->json(['message' => 'Locação removida com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function exportarAlugueisParaTxt()
    {
        $alugueis = Aluguel::with(['usuario', 'livro'])->get();

        $conteudo = '';

        foreach ($alugueis as $aluguel) {
            $conteudo .= "Usuário: {$aluguel->usuario->nome}\n";
            $conteudo .= "Livro: {$aluguel->livro->nome}\n";
            $conteudo .= "Data de Empréstimo: {$aluguel->dt_aluguel_ini}\n";
            $conteudo .= "Data de Devolução: {$aluguel->dt_aluguel_fim}\n\n";
        }

        $caminhoArquivo = storage_path('alugueis.txt');
        file_put_contents($caminhoArquivo, $conteudo);

        return response()->download($caminhoArquivo);
    }
}
