<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;
class DeleteController extends Controller
{
     public function destroy(ToDo $todo){
        // Pastikan user hanya bisa hapus todo miliknya
        if($todo->user_id !== Auth::id()){
            abort(403);
        }

        $todo->delete();
        return redirect()->route('home')->with('success', 'Todo berhasil dihapus!');
    }

}
