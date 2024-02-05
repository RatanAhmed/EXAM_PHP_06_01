<?php

namespace App\Http\Controllers;

use App\Models\MyColleague;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Framework\Error\Error;
use Yajra\DataTables\Facades\DataTables;

class MyColleagueController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Office::all();
            return DataTables::of($data)
                    ->addIndexColumn()

                    ->editColumn('no_of_colleague', function($data) {
                       return $data->colleaguesCount();
                    })

                    ->addColumn('action', function($data){
                        $btn = ' <a href="'.route('colleagues.show', $data->id ).'" class="btn btn-sm btn-success rounded editBtn"><i class="bi bi-pencil-square"></i> View </a>';
                        $btn .= ' <a href="'.route('colleagues.edit', $data->id ).'" class="btn btn-sm btn-warning rounded editBtn"><i class="bi bi-pencil-square"></i> Edit</a>';
                        $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class=" btn btn-sm btn-danger rounded deleteBtn"><i class="bi bi-trash"></i> Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'no_of_colleague' ])
                    ->make(true);
        }
        return view('colleague.index', [
            'page_title' => 'My Colleague',
            'index_route' => 'colleagues.index',
            'create_route' => 'colleagues.create',
            'delete_url' => 'colleagues',
            'columns' => [ 'office_name', 'office_address', 'no_of_colleague' ],
        ]);
    }

    public function create(){
        return view('colleague.create-edit', [
            'page_title' => 'Office Informations',
            'index_route' => 'colleagues.index',
            'store_route' => 'colleagues.store',
        ]);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'office_name' => 'required|string|max:255',
            'office_address' => 'required|string|max:255',
            'office_phone' => 'required|string|max:24',
        ]);

        if(isset($request->id)){
            $office = Office::find($request->id);
        }else{
            $office = new Office;
        }
        $office->fill($validated);
        if($request->hasFile('appointment_letter')){
            $office->appointment_letter = $this->saveFile($request->file('appointment_letter'));
        }
        if($office->save()){

            try{
                foreach($request->colleague_name as $key => $colleague_name){
                    if(isset($request->uuid)){
                        $colleague = MyColleague::whereUuid($request->uuid[$key])->first();
                    }else{
                        $colleague = new MyColleague;
                    }

                    $colleague->office_id = $office->id;
                    $colleague->colleague_name = $colleague_name;
                    $colleague->colleague_address = $request->colleague_address[$key];
                    $colleague->colleague_mobile = $request->colleague_mobile[$key];
                    if($request->hasFile('photo')){
                        $colleague->photo = $this->saveFile($request->photo[$key]);
                    }
                    $colleague->save();
                }
                toastr()->success('Saved Successfully !!', 'Success');
                return redirect()->route('colleagues.index');

            }catch(\Exception $e){
                toastr()->warning($e->getMessage(), 'Error');
                return back();
            }
        }
    }

    public function edit($uuid){
        return view('colleague.create-edit', [
            'data' => Office::whereId($uuid)->with('Colleagues')->first(),
            'page_title' => 'Update Information',
            'index_route' => 'colleagues.index',
            'store_route' => 'colleagues.store',
        ]);
    }
    public function show($uuid){
        return view('colleague.view', [
            'data' => Office::whereId($uuid)->with('Colleagues')->first(),
            'page_title' => 'View Details',
            'index_route' => 'colleagues.index',
            'store_route' => 'colleagues.store',
        ]);
    }

    public function destroy($uuid){
        if(MyColleague::whereId($uuid)->delete()){
            return response()->json(['success' => 'Deleted Successfully']);
        }else{
            return response()->json(['error' => 'Something went Wrong']);
        }
    }

    private function saveFile($file): string
    {
        $fileName = Str::random(15) . '.' . $file->getClientOriginalExtension();
        $path = 'colleague/photo'.'/'.$fileName;
        Storage::disk('public')->put($path, $file, 'public');
        return $path;
    }
}
