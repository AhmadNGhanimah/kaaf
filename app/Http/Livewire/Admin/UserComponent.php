<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserComponent extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function toggleAdmin($userId)
    {
        $user = User::find($userId);
        $user->role_as = !$user->role_as;
        $user->save();

        $this->users = User::all();
    }

    public function render()
    {

        return view('livewire.admin.user-component');
    }
}
