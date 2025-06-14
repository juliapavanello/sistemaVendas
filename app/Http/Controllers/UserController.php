<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DAO\UserDAO;

class UserController extends Controller
{
    public function index()
    {
        return view("/user/controleUsuarios");
    }

    public function create()
    {
        return view("/user/createUsuario", ["action" => 'create']);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        //Validação de dados
        $data['cpf'] = (int) preg_replace('/\D/', '', $data['cpf']);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|min:11|unique:users,cpf',
            'foto' => 'required|file|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //Senha padrão = CPF
        $data['password'] = $data['cpf'];

        // Armazena a foto com o nome do CPF
        $nomeFoto = $data['cpf'] . '.' . $request->file('foto')->getClientOriginalExtension();
        $request->file('foto')->storeAs('fotoUsuarios', $nomeFoto, 'public');

        UserDAO::create($data);
    }

    public function edit($id)
    {
        return view("/user/createUsuario", ["action" => 'edit']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        UserDAO::updateById($id, $data);
    }

    public function delete($id)
    {
        UserDAO::delete($id);
    }
}
