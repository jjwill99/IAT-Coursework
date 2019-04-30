<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\Adoption;
use App\User;
use App\Image;

class RequestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = Image::all();
        $animalsQuery = Animal::all();
        $userId = \Auth::user()->id;
        $adoptionsQuery = Adoption::all();
        return view('requests', array('animals'=>$animalsQuery, 'userId'=>$userId, 'adoptions'=>$adoptionsQuery, 'pictures'=>$pictures));
    }

    /**
     * Show the available animals page.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showAnimal($id){
        $animal = Animal::find($id);
        $pictures = Image::where("animalId", "=", $id)->get();
        return view('animal', array('animal'=>$animal, 'pictures'=>$pictures));
    }

    /**
     * Show the pending requests review page.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin(){
        $animalsQuery = Animal::all();
        $users = User::all();
        $adoptionsQuery = Adoption::all();
        return view('admin.requests', array('animals'=>$animalsQuery, 'users'=>$users, 'adoptions'=>$adoptionsQuery));
    }

}
