<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $classrooms = ClassRoom::paginate(3);
            $stages = Stage::select('ID','Name')->get();
            return view('pages.classrooms.index', compact('classrooms'))->with('stages', $stages);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'Ename' => 'required|string',
                'Aname' => 'required|string',
                'stage' => 'required|string'
            ]);
            $stages = Stage::where('Name->en', $request->stage)->orwhere('Name->ar', $request->stage)->first();
            $classroom = ClassRoom::create([
                'name' => ['en' => $request->Ename , 'ar' => $request->Aname],
                'stage_id' => $stages->ID,
            ]);
            $classroom->save();
            return redirect()->back()->with('message' , trans('messages.Success'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        try {
            $request->validate([
                'Ename' => 'required|string',
                'Aname' => 'required|string',
                'stage' => 'required|string'
            ]);
            $stages = Stage::where('Name->en', $request->stage)->orwhere('Name->ar', $request->stage)->first();
            $classRoom->where('id', $request->id)->update([
                'name' => ['en' => $request->Ename , 'ar' => $request->Aname],
                'stage_id' => $stages->ID,
            ]);
            return redirect()->back()->with('message', trans('messages.Success'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $classRoom , Request $request)
    {
        try
        {
            $classRoom->where('id' , $request->id)->delete();
            return redirect()->back()->with('message' , trans('messages.Success'));
        }
        catch (\Exception $e)   
        {
            return redirect()->back()->withErrors(['errors'=> $e->getMessage()]);   
        }
        
        
    }
    public function deleteAll(Request $request)
        {
            try 
            {
                $list = explode(',' , $request->id);
                $deleteselected = ClassRoom::whereIn('id' , $list)->delete();
                return redirect()->back()->with('message' , trans('messages.Success')); 
            }
            catch (\Exception $e)   
            {
                return redirect()->back()->withErrors(['errors'=> $e->getMessage()]);   
            }
        }
        public function specificSearch($id)
        {
            try 
                {
                    $specific = ClassRoom::where('stage_id',$id)->paginate(4);
                    $stages = Stage::all();
                    // return $specific;
                    return view('pages.classrooms.index')->with('stages',$stages)->withDetails($specific);
                    
                }
                catch (\Exception $e)   
                {
                    return redirect()->back()->withErrors(['errors'=> $e->getMessage()]);   
                }
        }
}
