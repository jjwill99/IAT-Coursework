<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\Adoption;

class RequestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animalsQuery = Animal::all();
        $userId = \Auth::user()->id;
        $adoptionsQuery = Adoption::all();
        return view('\requests', array('animals'=>$animalsQuery, 'userId'=>$userId, 'adoptions'=>$adoptionsQuery));
    }

}
