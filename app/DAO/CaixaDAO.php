<?php

    namespace App\DAO;

    use App\Models\Caixa;

    class CaixaDAO{
        public static function getById($id){
            return Caixa::find($id);
        }
        public static function getAll(){
            return Caixa::all();
        }
        public static function create(array $data){
            return Caixa::create($data);
        }
        public static function updateById($id,array $data){
            return Caixa::where("id",$id)->update($data);
        }
        public static function delete($id){
            return Caixa::destroy($id);
        }
    }
?>