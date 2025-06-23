<?php

    namespace App\DAO;

    use App\Models\Produto;

    class ProdutoDAO{
        public static function getById($id){
            return Produto::find($id);
        }
        public static function getAll(){
            return Produto::orderBy('id', 'asc')->get();;
        }
        public static function create(array $data){
            return Produto::create($data);
        }
        public static function updateById($id,array $data){
            return Produto::where("id",$id)->update($data);
        }
        public static function delete($id){
            return Produto::destroy($id);
        }
        public static function atualizarEstoque($id, $quantidade){
            return Produto::where('id', $id)->update(['quantidade'=>$quantidade]);
        }
    }
?>