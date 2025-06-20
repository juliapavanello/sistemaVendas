<?php

namespace App\Livewire;

use App\DAO\UserDAO;
use Livewire\Component;

class UserList extends Component
{
    public $users;

    public $listeners = ["userDeleted"];

    public function mount()
    {
        $this->users = UserDAO::getAll();
    }
    public function render()
    {
        return view('livewire.user-list');
    }
    public function userDeleted($userId)
    {
        // Remove o usuário da lista (memória)
        $this->users = $this->users->filter(fn($user) => $user->id != $userId);
    }
}
