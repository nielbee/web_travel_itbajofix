<?php

namespace App\Livewire\App;
use Livewire\Component;
use Livewire\WithFileUploads; 
use App\Models\packagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
class AddPackage extends Component
{
    use WithFileUploads;
    
    public $title, $description, $photo1, $photo2, $photo3, $price, $default_message;
    public bool $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }


 
    public function render()
    {
        return view('livewire.app.add-package',[
            'packages'=> packagesModel::all()
        ]);
    }

    public function save(){
        \Log::info('Save called!');

        $validated = $this->validate([
        'title' => 'required',
        'description' => 'required',
        'photo1' => 'nullable|image|mimes:jpg|max:1024',
        'photo2' => 'nullable|image|mimes:jpg|max:1024',
        'photo3' => 'nullable|image|mimes:jpg|max:1024',
        'price' => 'required|numeric',
        'default_message' => 'required',
    ]);
    
    try {
        $filename1 = 'photo1_'.$this->title.'_'.uniqid().'.jpg';
        $photo1Path = $this->photo1->storeAs('photos', $filename1, 'public');

        $filename2 = 'photo2_'.$this->title.'_'.uniqid().'.jpg';
        $photo2Path = $this->photo2->storeAs('photos', $filename2, 'public');

        $filename3 = 'photo3_'.$this->title.'_'.uniqid().'.jpg';
        $photo3Path = $this->photo3->storeAs('photos', $filename3, 'public');

         $mydata=[
            $this->title,
            $this->description,
            $photo1Path,
            $photo2Path,
            $photo3Path,
            $this->default_message,
            $this->price
        ];

        DB::insert('insert into travel_packages (title, description, photo1, photo2, photo3, default_message, price) values (?, ?, ?, ?, ?, ?, ?)', $mydata);
        session()->flash('message', 'Package saved successfully!');
        $this->reset(['title', 'description', 'photo1', 'photo2', 'photo3', 'price', 'default_message']);
        
    } catch (QueryException $th) {
       dd($th->getMessage());
    }

    }
}
