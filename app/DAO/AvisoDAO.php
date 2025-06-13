<?php

    namespace App\DAO;

    use App\Models\Aviso;

    class AvisoDAO{
        public static function getById($id){
            return Aviso::find($id);
        }
        public static function getAll(){
            return Aviso::all();
        }
        public static function create(array $data){
            return Aviso::create($data);
        }
        public static function updateById($id,array $data){
            return Aviso::where("id",$id)->update($data);
        }
        public static function delete($id){
            return Aviso::destroy($id);
        }
    }
?>