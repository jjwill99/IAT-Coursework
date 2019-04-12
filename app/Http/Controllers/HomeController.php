<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Adoption;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requested = false;
        $animalsQuery = Animal::all();
        $userId = \Auth::user()->id;
        $username = \Auth::user()->username;
        $adoptionsQuery = Adoption::all();
        return view('\home', array('animals'=>$animalsQuery, 'userId'=>$userId, 'username'=>$username, 'adoptions'=>$adoptionsQuery, 'requested'=>$requested));
    }

    public function admin()
    {
        return view('admin.admin_home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //form validation
        $adoption = $this->validate(request(), [
            'userId' => 'required',
            'animalId' => 'required',
        ]);

        //Create an Adoption object and set its values from the input
        $adoption = new Adoption;
        $adoption->userId = $request->input('userId');
        $adoption->animalId = $request->input('animalId');

        //Save the Adoption object
        $adoption->save();
        //Generate a redirect HTTP response with a success message
        return back()->with('success', 'Adoption request has been added');
    }

}
