<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CarouselEskul;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class dashboardController extends Controller
{
    public function index()
    {
        $carousels = CarouselEskul::latest()->get(); // atau ->take(5)
        $user = User::all()->count();
        return view('pages.dashboard', compact('user','carousels'));
    }

    public function error()
    {
        return view('error.401');
    }



}
