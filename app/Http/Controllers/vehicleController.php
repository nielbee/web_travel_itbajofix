<?php

namespace App\Http\Controllers;
use Livewire\WithFileUploads; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\vehicleModel;

class vehicleController extends Controller
{
    use WithFileUploads;
    public function save(Request $request){
        $filename1 = $request->id.'_pict1_'.uniqid().'.jpg';
        $photo1Path = $request->pict1->storeAs('photos', $filename1, 'public');
       
        $filename2 = $request->id.'_pict2_'.uniqid().'.jpg';
        $photo2Path = $request->pict2->storeAs('photos', $filename2, 'public');


        $filename3 = $request->id.'_pict3_'.uniqid().'.jpg';
        $photo3Path = $request->pict3->storeAs('photos', $filename3, 'public');

        
        //dd($request->all());
        $mydata = [
            $request->id,
            $request->brand,
            $request->model,
            $photo1Path,
            $photo2Path,
            $photo3Path,
            $request->price,
            $request->available,
            now(), // created_at
            now()  // updated_at
        ];
        try {
             DB::insert('insert into vehicles values (?, ?,?,?,?,?,?,?,?,?)', $mydata);
              session()->flash('message', 'Package saved successfully!');
              return redirect()->route('vehicles');
        } catch (\Throwable $th) {
            session()->flash('message', 'something went wrong! Please try again.');
        }
    }

    public function jsonData()
    {
        return response()->json(vehicleModel::all());
    }

    public function toogleAvailability($id)
    {
        $vehicle = vehicleModel::findOrFail($id);
        $vehicle->availability = !$vehicle->availability; // Toggle availability
        $vehicle->save();
        //session()->flash('message', 'saved successfully!');
        return redirect()->route('vehicles');
      //  return response()->json(['success' => true, 'availability' => $vehicle->availability]);
    }

    public function delete($id)
    {
        $vehicle = vehicleModel::findOrFail($id);
        $vehicle->delete();
        session()->flash('message', 'Vehicle deleted successfully!');
        return redirect()->route('vehicles');
    }



}
