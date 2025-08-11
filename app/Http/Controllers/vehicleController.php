<?php

namespace App\Http\Controllers;
use Livewire\WithFileUploads; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\vehicleModel;
use Illuminate\Support\Facades\Storage;

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
    // Paginate 10 items per page
    $vehicles = vehicleModel::paginate(10);

    // Transform the paginated items collection
    $vehicles->getCollection()->transform(function ($item) {
        $item->pict1 = asset('storage/' . $item->pict1);
        $item->pict2 = asset('storage/' . $item->pict2);
        $item->pict3 = asset('storage/' . $item->pict3);
        return $item;
    });

    // Return paginated response as JSON (includes pagination metadata)
    return response()->json($vehicles);
}

    public function jsonDataDetail($id)
    {
        $vehicle = vehicleModel::findOrFail($id);
        $data = $vehicle->toArray();
        
        $data['pict1'] = asset('storage/' . $data['pict1']);
        $data['pict2'] = asset('storage/' . $data['pict2']);
        $data['pict3'] = asset('storage/' . $data['pict3']);
        
        return response()->json($data);
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
        Storage::disk('public')->delete($vehicle->pict1);
        Storage::disk('public')->delete($vehicle->pict2);
        Storage::disk('public')->delete($vehicle->pict3);

        $vehicle->delete();
        session()->flash('message', 'Vehicle deleted successfully!');
        return redirect()->route('vehicles');
    }

    public function paymentPreview($id){
        return view('payment/vehicle',[
            'vehicle' => vehicleModel::findOrFail($id)
        ]);
    }



}
