<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class StageController extends Controller
{
    
    public function index()
    {
       try {
        $stage = Stage::select('ID' , 'Name' , 'Note')->paginate(10);
        // $stage = Stage::paginate(5);
        return view('pages.stages.index' , compact('stage'));
       }
       catch(\Exception $e) {
        return $e->getMessage();
       }
    }

   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            
            $stage = new Stage();
            $request->validate([
                'eName'=> 'required|string',
                'aName'=> 'required|string',
                'eNote'=> 'required|string',
                'aNote'=> 'required|string',
            ]);
            $stage->Name = ['en' => $request->eName , 'ar' => $request->aName];
            $stage->Note = ['en' => $request->eNote , 'ar' => $request->aNote];
            $stage->Save();
            return redirect()->back()->with('message' , trans('messages.Success'));
        }
        catch(\Exception $e)    
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // return $e->getMessage();    
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       
        try
        {
            $request->validate([
                'eName'=> 'required|string',
                'aName'=> 'required|string',
                'eNote'=> 'required|string',
                'aNote'=> 'required|string',
            ]);
            $stage = Stage::where('ID' , $request->id)->update(
                [
                    'Name' => ['en' => $request->eName , 'ar' => $request->aName ],
                    'Note' => ['en' => $request->eNote , 'ar' => $request->aNote]
                ]
                );
                // $stage->Save();
                return redirect()->back()->with('message' , trans('messages.Success'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }    
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $class_id = ClassRoom::where('stage_id' , $request->id)->pluck('stage_id');
            if ($class_id->count() == 0)
            {
                $stage = Stage::where('ID' , $request->id)->delete();
                return redirect()->back()->with('message' , trans('messages.Success'));
            }
            else
            {
                return redirect()->back()->with('message' , trans('messages.S_Failed'));
            }
           
        }
        catch(\Exception $e)    
        {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    public function deleteAll(Request $request)
    {
        try 
            {
                $list = explode(',' , $request->id);
                $deleteselected = Stage::whereIn('ID' , $list)->delete();
                return redirect()->back()->with('message' , trans('messages.Success')); 
            }
            catch (\Exception $e)   
            {
                return redirect()->back()->withErrors(['errors'=> $e->getMessage()]);   
            }
    }
   
}
