<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\DateHelper;

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

        // attach formatted date strings for convenience
        $todo->created_at_formatted = DateHelper::formatDate($todo->created_at, 'M d, Y H:i');
        $todo->updated_at_formatted = DateHelper::formatDate($todo->updated_at, 'M d, Y H:i');
        $todo->deadline_for_input = $todo->deadline ? DateHelper::formatDate($todo->deadline, 'Y-m-d') : null;
        $todo->completed_at_formatted = $todo->completed_at ? DateHelper::formatDate($todo->completed_at, 'M d, Y H:i') : null;

        return view('todos.edit', compact('todo'));
    }
}
