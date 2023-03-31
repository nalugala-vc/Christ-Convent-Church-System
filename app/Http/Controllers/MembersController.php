<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mime\Email;

class MembersController extends Controller
{
    public function index(){
        $members = Members::all();

        return view('members.viewAllMembers',[
            'members'=>$members
        ]);
    }

    public function search (){
        $members = Members::all();
        $children = Children::all();

        $membersArray = $members->pluck('name','id')->toArray();
        $childrenArray = $children->pluck('name', 'id')->toArray();

        $mergedArray = array_merge($membersArray, $childrenArray);

        return $mergedArray;
    }

    public function searchMembers(){
        $memberName = request()->members_name;
        $type_search = request()->type_search;

        if(!$memberName!==null){
            if($type_search === "members"){
                $member = Members::where('name', 'LIKE', '%' . $memberName . '%')->first();
                if($member){
                    return redirect('/searchedMember/'.$member->id);
                }else{
                    return redirect()->back()->with('error','Member not found in our records');
                }
            }

            if($type_search === "children"){
                $child = Children::where('name', 'LIKE', '%' . $memberName . '%')->first();
                if($child){
                    return redirect('/searchedChild/'.$child->id);
                }else{
                    return redirect()->back()->with('error','Child not found in our records');
                }
            }
            
        }else{
            return redirect()->back();
        }
    }

    public function searchedMember($member){
        $member = Members::findOrFail($member);

        return view('members.searched',[
            'member' => $member
        ]);
    }

    public function getMembersNames(){
        $members =  Members::pluck('name')->toArray();
        return response()->json($members);
    }

    public function memberDetails($member){
        $member = Members::findOrFail($member);
        return view('members.viewMembersDetails',[
            'member'=>$member
        ]);
    }

    public function registerMember(){
        return view('members.registerMembers');
    }

    public function addMember(){
        $exists=DB::table('members')->where('email', request()->email)->exists();
        $filename=null;
        if($exists){
            return redirect()->back()->with('error','Email already exists');
        }

        request()->validate([
            'name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'home_address'=>'required',
        ]);

        if(request()->hasFile('profile_picture')) {
            $file = request()->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assets', $filename);
        }

        Members::create([
            'name'=>request()->name,
            'email'=>request()->email,
            'profile_picture'=>$filename,
            'spouse_name'=>request()->spouse_name,
            'phone_number'=>request()->phone_number,
            'home_address'=>request()->home_address,
        ]);

        return redirect()->route('members')->with('success','Member Registered  successfully');
    }

    public function editMember($member){
        $member = Members::findOrFail($member);

        return view('members.editMember',[
            'member'=>$member
        ]);
    }

    public function updateMember($member){
        $updatedMember = [];

        request()->validate([
            'name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'home_address'=>'required',
        ]);

        if(request()->hasFile('profile_picture')) {
            $file = request()->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assets', $filename);
            $updatedMember['profile_picture'] = $filename;
        }

        $updatedMember['name'] = request()->name;
        $updatedMember['email'] = request()->email;
        $updatedMember['home_address'] = request()->home_address;
        $updatedMember['phone_number'] = request()->phone_number;
        $updatedMember['spouse_name'] = request()->spouse_name;

        Members::where('id',$member)->update($updatedMember);

        return redirect()->route('members')->with('success','Member updated  successfully');

    }

    public function deleteMember($member){
        $member =Members::findOrFail($member);

        try {
            $member->delete();

            return redirect()->route('members')->with('success','Member updated  successfully');
        } catch (\Throwable $th) {
            return redirect()->route('members')->with('error','An error occurred while deleting member');
        }
    }
}
