<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $book = Book::Where('user_id',auth()->id)
        ->latest()
        ->get();
        return view('dashboard',compact('book'));
    }
    public function store(Request $request){
        $data = $request->validate([
            'title'=> 'required|
            string|max:100',
            'page' => 'required| integer|min1|max:1000'


        ]);
        $data['user_id'] = auth()->id;
        Book::create($data);
        return
        redirect()->route('dashboard')->with('success','book had registerd!');
    }
}
