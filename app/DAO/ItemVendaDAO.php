<?php

    namespace App\DAO;

    use App\Models\ItemVenda;

    class ItemVendaDAO{
        public static function getById($id){
            return ItemVenda::find($id);
        }
        public static function getByIdVenda($id){
            return ItemVenda::where('venda_id', $id)->get();
        }
        public static function getAll(){
            return ItemVenda::all();
        }
        public static function create(array $data){
            return ItemVenda::create($data);
        }
        public static function updateById($id,array $data){
            return ItemVenda::where("id",$id)->update($data);
        }
        public static function delete($id){
            return ItemVenda::destroy($id);
        }
    }
?>