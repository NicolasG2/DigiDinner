<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\Mesa;
use App\Models\User;

class AtendimentoController extends Controller
{
    
    public function index()
    {
        //
    }

    public function main()
    {
        $atendimentos = Atendimento::orderby('id')->get();
        $mesas = Mesa::orderBy('numero')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $atendentes = User::orderBy('nome')->get();

        return view('templates.main', compact('atendimentos', 'mesas', 'clientes', 'atendentes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'num_pessoas' => 'required|integer',
            'comentario' => 'nullable|string',
            'cliente_id' => 'nullable|exists:cliente_id',
            'mesa_id' => 'required|exists:mesa_id',
            'user_id' => 'required|exists:user_id',
        ]);

        $atendimento = Atendimento::create($data);

        return response()->json([
            'success' => true,
            'mesa' => $atendimento->mesa,
        ]);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}