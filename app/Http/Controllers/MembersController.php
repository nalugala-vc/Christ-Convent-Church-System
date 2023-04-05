<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Members;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Mime\Email;

class MembersController extends Controller
{
    public function index(){
        $members = Members::all();

        return view('members.viewAllMembers',[
            'members'=>$members
        ]);
    }
    public function Login(){
        return view('auth.login');
    }

    public function registerAdmin(){
        return view('users.register');
    }

    public function addAdmin(){
        $users = User::all()->count();

        if($users>7){
            return redirect()->back()->with('error','Admin members cannot be more than 7 members');
        }

        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => ['required','confirmed'],
        ]);

        User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);

        return redirect()->back()->with('success','Admin added successfully');
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

            // Update children with this member as mother, father or guardian
            $mother = Children::where('mother_id', $member->id)->get();
            $father = Children::where('father_id', $member->id)->get();
            $guardian = Children::where('guardian_id', $member->id)->get();

            foreach($mother as $child) {
                $child->update(['mother_id' => null]);
            }

            foreach($father as $child) {
                $child->update(['father_id' => null]);
            }

            foreach($guardian as $child) {
                $child->update(['guardian_id' => null]);
            }
            
            $member->delete();

            return response()->json([ 
                'redirect' => '/members',        
                'message' => 'Member deleted successfully',
                'status' => 'success'
            ]);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([ 
                'redirect' => '/members',        
                'message' => 'An error occurred while deleting',
                'status' => 'error',
            ]);
        }
    }
}
