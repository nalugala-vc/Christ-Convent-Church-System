<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Email;

class MembersController extends Controller
{
    public function index(){
        $members = Members::all();

        return view('members.viewAllMembers',[
            'members'=>$members
        ]);
    }

    public function getMembersNames(){
        $members =  Members::pluck('name')->toArray();
        return response()->json($members);
    }

    public function memberDetails($member){
        $member = Member::findOrFail($member);
        return view('members.viewMembersDetails',[
            'member'=>$member
        ]);
    }

    public function registerMember(){
        return view('members.registerMember');
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

        return redirect()->route('viewUsers')->with('success','Member Registered  successfully');
    }

    public function editMember($member){
        $member = Member::findOrFail($member);

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

        return redirect()->route('viewUsers')->with('success','Member updated  successfully');

    }

    public function deleteMember($member){
        $member =Members::findOrFail($member);

        $member->delete();

        return redirect()->route('viewUsers')->with('success','Member updated  successfully');
    }
}
