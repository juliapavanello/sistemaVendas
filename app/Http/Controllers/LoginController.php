<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\UserDAO;

class LoginController extends Controller
{
    public function index()
    {
        return view("/user/login");
    }

    public function create()
    {
        return view("/user/createUsuario", ["action" => 'create']);
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
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
        UserDAO::updateById($id,$data);
    }

    public function delete($id)
    {
        UserDAO::delete($id);
    }
}
