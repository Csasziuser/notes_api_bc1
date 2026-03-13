<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notes = $request->user()->notes;

        return response()->json($notes,200, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $request->user()->notes()->create([
            'title' => $request["title"],
            'content' => $request["content"]
        ]);

        return response()->json(
            ['message' => 'Jegyzet sikeresen mentve!'],
            201,options:JSON_UNESCAPED_UNICODE);
    }
}
