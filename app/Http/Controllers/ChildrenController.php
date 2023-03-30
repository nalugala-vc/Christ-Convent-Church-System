<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    public function index(){
        $children = Children::all();
        return view ('children.viewAllChildren',[
            'children' => $children
        ]);
    }

    public function childDetails($child){
        $child = Children::findOrFail($child);

        return view('children.viewChildsDetails',[
            'child'=>$child,
        ]);
    }

    public function registerChild(){
        return view('children.registerChildren');
    }

    public function addChild(){
        $filename=null;
        $father = null;
        $father_id = null;
        $mother = null;
        $mother_id = null;
        $guardian = null;
        $guardian_id = null;

        request()->validate([
            'name' => 'required',
            'DOB' => 'required',
        ]);

        if(request()->email){
            $exists=DB::table('childrens')->where('email', request()->email)->exists();
            if($exists){
                return redirect()->back()->with('error','Child already exists');
            }
        }

        if(request()->father_name){
            $father_name = request()->father_name;
            $father = Members::where('name', $father_name)->firstOrFail();

            if($father){
                $father_id = $father->id;
            }
        }

        if(request()->mother_name){
            $mother_name = request()->mother_name;
            $mother = Members::where('name', $mother_name)->firstOrFail();

            if($mother){
                $mother_id = $mother->id;
            }
        }

        if(request()->guardian_name){
            $guardian_name = request()->guardian_name;
            $guardian = Members::where('name', $guardian_name)->firstOrFail();

            if($guardian){
                $guardian_id = $guardian->id;
            }
        }
        


        if(request()->hasFile('profile_picture')) {
            $file = request()->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assets', $filename);
        }

        Children::create([
            'name'=> request()->name,
            'email' => request()->email,
            'father_id' => $father_id,
            'mother_id' => $mother_id,
            'guardian_id'=> $guardian_id,
            'profile_picture'=>$filename,
            'phone_number'=>request()->phone_number,
            'DOB' => request()->DOB,
        ]);

        return redirect()->route('children')->with('success','Child registered  successfully');
    }

    public function editChild($child){
        $child = Children::findOrFail($child);

        return view('children.editChild',[
            'child' => $child
        ]);
    }

    public function updateChild($child){
        $updatedChild = [];
        request()->validate([
            'name' => 'required',
            'DOB' => 'required',
        ]);

        if(request()->father_name){
            $father_name = request()->father_name;
            $father = Members::where('name', $father_name)->firstOrFail();

            if($father){
                $father_id = $father->id;
            }
        }

        if(request()->mother_name){
            $mother_name = request()->mother_name;
            $mother = Members::where('name', $mother_name)->firstOrFail();

            if($mother){
                $mother_id = $mother->id;
            }
        }

        if(request()->guardian_name){
            $guardian_name = request()->guardian_name;
            $guardian = Members::where('name', $guardian_name)->firstOrFail();

            if($guardian){
                $guardian_id = $guardian->id;
            }
        }

        if(request()->hasFile('profile_picture')) {
            $file = request()->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assets', $filename);
            $updatedChild['profile_picture'] = $filename;
        }

        $updatedChild['name'] = request()->name;
        $updatedChild['email'] = request()->email;
        $updatedChild['father_id'] = $father_id;
        $updatedChild['mother_id'] = $mother_id;
        $updatedChild['guardian_id'] = $guardian_id;
        $updatedChild['phone_number'] = request()->phone_number;
        $updatedChild['DOB'] = request()->DOB;

        Children::where('id',$child)->update($updatedChild);

        return redirect()->route('children')->with('success','Child Updated successfully');
    }

    public function deleteChild($child){
        $child = Children::findOrFail($child);

        $child->delete();

        return redirect()->route('children')->with('success','Child deleted successfully');
    }
}

/*
#657ddd->dark purple
#6557cf->light purple
#333333->Dark grey
#202020->almost black
#a342b5->lighr pink
#e96c96->pink color
#d54d97->1st div pink
#ee8a72->orange color*/