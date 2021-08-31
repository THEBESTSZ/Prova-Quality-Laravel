<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use App\Models\Funcionario;
use App\Models\Dependente;
use App\Http\Requests\FuncionarioRequest;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    private $totalPage = 3;

    public function store(FuncionarioRequest $req) {
        $funcionario = new Funcionario;

        try {
            //print_r($req->input());
            $funcionario->nome = $req->nome;
            $funcionario->email = $req->email;
            $funcionario->nascimento = $req->nascimento;

            // Image Upload
            if($req->hasFile('foto') && $req->file('foto')->isValid()) {

                $requestImage = $req->foto;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/funcionarioFotos'), $imageName);

                $funcionario->foto = $imageName;

            }

            $funcionario->save();
            return redirect('/lista');
            //$funcionario = new Funcionario();
            //$funcionario->Create($funcionarioData);
            //return response()->json($newModel, 201);
        } catch (ValidationException $e) {
            //return response()->json(['errors' => $e->getErrors()], 400);
        }
    }

    public function show(){
        //$data = Funcionario::all();
        //return view('/lista', ['funcionarios'=>$data]);
        $data = Funcionario::paginate($this->totalPage);
        return view('/lista', ['funcionarios'=>$data]);
    }

    public function showById($id){
        $funcionario = Funcionario::findOrFail($id);
        $dependentes = Dependente::where('funcionario_id', $id)->get();
        return view('dependentes', ['funcionario' => $funcionario, 'dependentes' => $dependentes]);
    }

    public function edit(Request $req){
        //print_r($req->input());
        $id = $req->cId;
        $status = $req->status;
        $paginaAtual = $req->paginaAtual;
        //dd($req->input());

        if(!isset($status)){
            $status = 0;
        }

        Funcionario::where('id', $id)->update(['status' => $status]);

        return redirect('/lista?page='.$paginaAtual);
    }

    public function remove(Request $req){
        // print_r($req->input());
        $ids = $req->ids;
        // print_r($ids);

        $can_foreach = is_array($ids) || is_object($ids);
        if ($can_foreach) {
            foreach ($ids as $id){
                $funcionario = Funcionario::findOrFail($id);
                $funcionario->delete();
            }
        }else{
            $funcionario = Funcionario::findOrFail($ids);
            $funcionario->delete();
        }

        FuncionarioController::show();
    }
}
