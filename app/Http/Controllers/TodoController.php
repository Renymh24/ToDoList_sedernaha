<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TodoController extends Controller
{
    //untuk menampilkan data todo
    public function index(){
        $todos = ToDo::where('user_id', Auth::id())
                    ->orderBy('deadline', 'asc')
                    ->get();

        foreach($todos as $todo) {
            if($todo->deadline && Carbon::parse($todo->deadline)->isPast() && $todo->status === 'pending') {
                $todo->update(['status' => 'late']);
            }
        }

        $stats = [
            'total' => $todos->count(),
            'completed' => $todos->where('status', 'completed')->count(),
            'pending' => $todos->where('status', 'pending')->count(),
            'late' => $todos->where('status', 'late')->count(),
        ];

        return view('index', compact('todos', 'stats'));
    }

    //untuk menampilkan halaman create todo
    public function create(){
        return view('todos.create');
    }

    //untuk menampilkan halaman edit todo
    public function edit(ToDo $todo){
        // Pastikan user hanya bisa edit todo miliknya
        if($todo->user_id !== Auth::id()){
            abort(403);
        }

        return view('todos.edit', compact('todo'));
    }
}
