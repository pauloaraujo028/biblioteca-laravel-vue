<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Utils\CpfUtil;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        $usuarios = $usuarios->map(function ($usuario) {
            $usuario->dt_inclusao = (new \DateTime($usuario->dt_inclusao))->format('d/m/Y');
            $usuario->dt_alteracao = (new \DateTime($usuario->dt_alteracao))->format('d/m/Y');
            return $usuario;
        });

        if (request()->wantsJson()) {
            return response()->json($usuarios);
        }

        return Inertia::render('Usuarios', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return Inertia::render('Usuarios');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required',
                'cpf' => 'required|unique:usuarios',
            ], [
                'cpf.cpf_valido' => 'O CPF inserido é inválido.',
            ]);

            $cpf = $request->input('cpf');
            $usuarioExistente = Usuario::where('cpf', $cpf)->first();

            if ($usuarioExistente) {
                return response()->json(['error' => 'Erro ao cadastrar o usuário. O CPF já foi utilizado.'], 500);
            }

            $now = now();

            DB::table('usuarios')->insert([
                'nome' => $request->input('nome'),
                'cpf' => $request->input('cpf'),
                'dt_inclusao' => $now,
                'dt_alteracao' => $now,
            ]);

            return response()->json(['message' => 'Usuário cadastrado com sucesso'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar o usuário. O CPF já foi utilizado.'], 500);
        }
    }

    public function show($usuario_id)
    {
        $usuario = Usuario::findOrFail($usuario_id);
        return Inertia::render('Usuarios/Show', ['usuario' => $usuario]);
    }

    public function edit($usuario_id)
    {
        $usuario = Usuario::findOrFail($usuario_id);
        return Inertia::render('Usuarios/Edit', ['usuario' => $usuario]);
    }

    public function update(Request $request, $usuario_id)
    {
        try {
            $usuario = Usuario::findOrFail($usuario_id);

            $request->validate([
                'nome' => 'required',
                'cpf' => 'required|unique:usuarios,cpf,' . $usuario->usuario_id . ',usuario_id',
            ], [
                'cpf.cpf_valido' => 'O CPF inserido é inválido.',
            ]);

            $cpf = $request->input('cpf');
            $usuarioExistente = Usuario::where('cpf', $cpf)->where('usuario_id', '!=', $usuario->usuario_id)->first();

            if ($usuarioExistente) {
                return response()->json(['error' => 'Erro ao atualizar o usuário. O CPF já foi utilizado.'], 500);
            }

            $now = now();

            DB::table('usuarios')->where('usuario_id', $usuario_id)->update([
                'nome' => $request->input('nome'),
                'cpf' => $request->input('cpf'),
                'dt_alteracao' => $now,
            ]);

            return response()->json(['message' => 'Usuário atualizado com sucesso', 'usuario' => $usuario], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o usuário: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($usuario_id)
    {
        try {
            $usuario = Usuario::findOrFail($usuario_id);
            $usuario->delete();

            return response()->json(['message' => 'Usuário removido com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
