<?php

namespace App\Http\Controllers;
use App\Models\Board;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class BoardController extends Controller
{
    //
    
        public function dashboard($id = 1) {
        $board = Board::with(['lanes.tasks.labels'])->findOrFail($id);
        $board = Board::with(['lanes.tasks'])->findOrFail($id);
        $users = User::orderBy('name')->get(['id','name','email']);
        
        return view('dashboard', compact('board','users'));
    }
    
}
