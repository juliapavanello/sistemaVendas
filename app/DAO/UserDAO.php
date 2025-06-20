<?php

namespace App\DAO;

use App\Models\User;

class UserDAO
{
    public static function getById($id)
    {
        return User::find($id);
    }
    public static function getAll()
    {
        return User::all();
    }
    public static function create(array $data)
    {
        return User::create($data);
    }
    public static function updateById($id, array $data)
    {
        return User::where("id", $id)->update($data);
    }
    public static function delete($id)
    {
        return User::destroy($id);
    }
}
?>