<?php

    namespace App\DAO;

    use App\Models\Caixa;
    use Illuminate\Support\Carbon;

    class CaixaDAO{
        public static function getById($id){
            return Caixa::find($id);
        }
        public static function getAll(){
            return Caixa::orderBy('id')->get();;
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

        public static function getLast30Days(){
            return Caixa::where('created_at', '>=', Carbon::now()->subDays(30))->get();
        }
    }
?>