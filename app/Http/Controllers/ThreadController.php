<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function index(Thread $thread)
    {
        return view('threads.index')->with(['threads'=>$thread->getByLimit()]);
    }
}
