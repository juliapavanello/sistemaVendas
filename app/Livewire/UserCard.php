<?php

namespace App\Livewire;

use Livewire\Component;
use App\DAO\UserDAO;
use Illuminate\Support\Facades\Storage;

class UserCard extends Component
{
    public $user;
    public $carregarTipo;
    public $listeners = ["updateTipo","updateBlock"];

    public function mount($id, $carregarTipo)
    {
        $this->carregarTipo = $carregarTipo;
        $this->user = UserDAO::getById($id);
    }
    public function render()
    {
        return view('livewire.user');
    }

    public function destroy()
    {
        Storage::disk('public')->delete('fotoUsuarios/'. $this->user->foto);
        UserDAO::delete($this->user->id);
        // Emite para o componente pai que o usuário foi deletado
        $this->dispatch('userDeleted', ['userId' => $this->user->id]);
    }

    public function updateTipo($data)
    {
        if ($data[0] != $this->user->id)
            return;
        $this->user->tipo = $data[1];
        UserDAO::updateById($this->user->id, ["tipo" => $data[1]]);
        if ($data[1] != "Admin" && $data[1] != "Barraca") {
            $this->carregarTipo = true;
        } else {
            $this->carregarTipo = false;
        }
    }

    public function updateBlock($data)
    {
        if ($data[0] != $this->user->id)
            return;
        $this->user->bloqueio = $data[1];
        UserDAO::updateById($this->user->id, ["bloqueio" => $data[1]]);
    }
}
