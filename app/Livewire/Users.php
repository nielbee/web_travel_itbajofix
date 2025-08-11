<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use function Termwind\render;

class Users extends Component
{

    public bool $showModal = false;
    public $name;
    public $email;
    public $password;
    public function openModal()
    {
        $this->showModal = true;
    }

    public function render()
    {
       
        $users = User::whereNotIn('id', [1])->get();   // admin id 1 one. dont forget to run php artisan db:seed
        return view('livewire.users',['users'=>$users]);
    }

    public function delete(int $id){
        User::find($id)->delete();
    }

    public function save(){
        $user = User::factory()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password) // Ensure to set a password
        ]);
        $this->showModal = false;   
        
        $user->assignRole('user');
    }
}
