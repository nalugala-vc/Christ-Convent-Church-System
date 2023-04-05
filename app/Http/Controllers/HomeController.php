<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Members;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $members = Members::latest()->take(5)->get();
        $memberCount = Members::all()->count();
        $childrenCount = Children::all()->count();
        return view('users.userDashboard',[
            'members' => $members,
            'memberCount' => $memberCount,
            'childrenCount' => $childrenCount
        ]);
    }
}
