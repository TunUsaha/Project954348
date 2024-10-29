<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function send(Request $request)
    {
        // Validation and logic to send message
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send or store message logic here (e.g., email or save to database)
        
        return redirect()->route('contact')->with('success', 'Message sent successfully!');
    }
}
