<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
         
         $validated = $request->validate([
             'message' => 'required|string|max:255',
         ]);
  
         $request->user()->chirps()->create($validated);
  
         return redirect(route('chirps.index'));
    }
 


}
