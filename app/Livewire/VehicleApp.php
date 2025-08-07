<?php
namespace App\Livewire;
use App\Models\vehicleModel;
use Livewire\Component;

class VehicleApp extends Component
{
    public $showModal = false;
    public $available = true;
    public function openModal()
    {
        $this->showModal = true;
        // dd('Modal opened');
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.vehicle-app',['vehicles'=> vehicleModel::all()]);
        
    }

}
?>