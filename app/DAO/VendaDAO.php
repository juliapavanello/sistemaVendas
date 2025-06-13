<?php

    namespace App\DAO;

    use App\Models\Venda;

    class VendaDAO{
        public static function getById($id){
            return Venda::find($id);
        }
        public static function getAll(){
            return Venda::all();
        }
        public static function create(array $data){
            return Venda::create($data);
        }
        public static function updateById($id,array $data){
            return Venda::where("id",$id)->update($data);
        }
        public static function delete($id){
            return Venda::destroy($id);
        }
    }
?>