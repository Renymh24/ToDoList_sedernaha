<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\DateHelper;

class TodoController extends Controller
{
    //untuk menampilkan data todo
    public function index(Request $request){
        $query = ToDo::where('user_id', Auth::id());

        // Pencarian berdasarkan deskripsi atau title
        if($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('description', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('title', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Filter berdasarkan status
        if($request->has('status') && $request->status != '' && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $todos = $query->orderBy('deadline', 'asc')->get();

        foreach($todos as $todo) {
            if($todo->deadline && DateHelper::isPast($todo->deadline) && $todo->status === 'pending') {
                $todo->update(['status' => 'late']);
            }
        }

        // Format data untuk view
        $formattedTodos = $todos->map(function($todo) {
            return $this->formatTodoData($todo);
        });

        $stats = [
            'total' => $todos->count(),
            'completed' => $todos->where('status', 'completed')->count(),
            'pending' => $todos->where('status', 'pending')->count(),
            'late' => $todos->where('status', 'late')->count(),
        ];

        return view('index', [
            'todos' => $formattedTodos, 
            'stats' => $stats,
            'search' => $request->search ?? '',
            'status' => $request->status ?? 'all'
        ]);
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

        // Format data untuk view
        $formattedTodo = $this->formatTodoData($todo);

        return view('todos.edit', ['todo' => $formattedTodo]);
    }

    /**
     * Format todo data dengan DateHelper
     */
    private function formatTodoData($todo)
    {
        $deadlineBadge = DateHelper::formatDeadlineWithColor($todo->deadline);
        
        return (object) [
            'id' => $todo->id,
            'user_id' => $todo->user_id,
            'title' => $todo->title,
            'description' => $todo->description,
            'status' => $todo->status,
            'deadline' => $todo->deadline,
            'completed_at' => $todo->completed_at,
            'created_at' => $todo->created_at,
            'updated_at' => $todo->updated_at,
            
            // Formatted fields
            'deadline_formatted' => DateHelper::formatIndonesian($todo->deadline),
            'deadline_short' => DateHelper::formatShort($todo->deadline),
            'deadline_relative' => DateHelper::formatRelative($todo->deadline),
            'deadline_badge_text' => $deadlineBadge['text'],
            'deadline_badge_color' => $deadlineBadge['color'],
            'deadline_for_input' => DateHelper::formatForInput($todo->deadline),
            'deadline_days_until' => DateHelper::daysUntil($todo->deadline),
            'deadline_is_past' => DateHelper::isPast($todo->deadline),
            'deadline_is_today' => DateHelper::isToday($todo->deadline),
            'deadline_is_tomorrow' => DateHelper::isTomorrow($todo->deadline),
            
            'completed_at_formatted' => DateHelper::formatIndonesian($todo->completed_at),
            'completed_at_with_time' => DateHelper::formatWithTime($todo->completed_at),
            
            'created_at_formatted' => DateHelper::formatIndonesian($todo->created_at),
            'updated_at_formatted' => DateHelper::formatIndonesian($todo->updated_at),
        ];
    }
}
