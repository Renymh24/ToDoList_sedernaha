<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'deadline' => 'nullable|date|after_or_equal:today',
        ], [
            'title.required' => 'Judul todo wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'description.max' => 'Deskripsi maksimal 1000 karakter',
            'deadline.date' => 'Format tanggal tidak valid',
            'deadline.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini',
        ]);

        ToDo::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Todo berhasil ditambahkan!');
    }
}
