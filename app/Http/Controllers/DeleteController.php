<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ToDo;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
     public function destroy(ToDo $todo){
        // Pastikan user hanya bisa hapus todo miliknya
        if($todo->user_id !== Auth::id()){
            abort(403);
        }

        // Log data sebelum delete
        $deletedData = [
            'id' => $todo->id,
            'title' => $todo->title,
            'description' => $todo->description,
            'deadline' => $todo->deadline,
            'status' => $todo->status,
        ];

        $todo->delete();

        // Log delete task
        Log::info('Task deleted successfully', [
            'task_id' => $deletedData['id'],
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'deleted_data' => $deletedData,
            'timestamp' => now()->toDateTimeString()
        ]);

        return redirect()->route('home')->with('success', 'Todo berhasil dihapus!');
    }

}
