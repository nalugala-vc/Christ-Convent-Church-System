<?php

namespace App\Http\Controllers;

use App\Models\Children;
use Illuminate\Http\Request;

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
        request()->validate([
            'name' => 'required',
            'DOB' => 'required',
        ]);

        if(request()->hasFile('profile_picture')) {
            $file = request()->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assets', $filename);
        }

        Children::create([
            'name'=> request()->name,
            'email' => request()->email,
            'father_id' => request()->father_id,
            'mother_id' => request()->mother_id,
            'guardian_id'=>request()->guardian_id,
            'profile_pricture'=>$filename,
            'phone_number'=>request()->phone_number,
            'DOB' => request()->DOB,
        ]);

        return redirect()->route('viewUsers')->with('success','Child registered  successfully');
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

        if(request()->hasFile('profile_picture')) {
            $file = request()->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assets', $filename);
            $updatedChild['profile_picture'] = $filename;
        }

        $updatedChild['name'] = request()->name;
        $updatedChild['email'] = request()->email;
        $updatedChild['father_id'] = request()->father_id;
        $updatedChild['mother_id'] = request()->mother_id;
        $updatedChild['guardian_id'] = request()->guardian_id;
        $updatedChild['phone_number'] = request()->phone_number;
        $updatedChild['DOB'] = request()->DOB;

        Children::where('id',$child)->update($updatedChild);

        return redirect()->route('viewUsers')->with('success','Child Updated successfully');
    }

    public function deleteChild($child){
        $child = Children::findOrFail($child);

        $child->delete();

        return redirect()->route('viewUsers')->with('success','Child deleted successfully');
    }
}
