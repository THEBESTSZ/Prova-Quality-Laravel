<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use App\Models\Funcionario;
use App\Models\Dependente;
use App\Http\Requests\DependenteRequest;
use Illuminate\Http\Request;

class DependenteController extends Controller
{
    public function store(DependenteRequest $req) {
        $dependente = new Dependente;

        try {
            $req->validated();
            //print_r($req->input());
            //return redirect('/lista');
            $dependente->nome = $req->nome;
            //$funcionario->email = $req->cEmail;
            $dependente->nascimento = $req->nascimento;
            $dependente->funcionario_id = $req->funcionarioId;
            $dependente->save();
            return redirect('/dependentes/'.$dependente->funcionario_id);
            //$funcionario = new Funcionario();
            //$funcionario->Create($funcionarioData);
            //return response()->json($newModel, 201);
        } catch (ValidationException $e) {
            //return response()->json(['errors' => $e->getErrors()], 400);
        }
    }

    public function show(){
        $data = Funcionario::all();
        return view('/lista',['funcionarios'=>$data]);
    }

    public function showById($id){
        $funcionario = Funcionario::findOrFail($id);
        $dependentes = Dependente::where('funcionario_id', $id)->get();
        return view('dependentes', ['funcionario' => $funcionario, '$depedentes' => $dependentes]);
    }

    public function remove(Request $req){
        //print_r($req->input());
        $id = $req->cId;

        $dependente = Dependente::findOrFail($id);
        $funcionario = Funcionario::findOrFail($dependente->funcionario_id);


        $dependente->delete();

        $dependentes = Dependente::where('funcionario_id', $funcionario->id)->get();
        return view('dependentes', ['funcionario' => $funcionario, 'dependentes' => $dependentes]);
    }
}
