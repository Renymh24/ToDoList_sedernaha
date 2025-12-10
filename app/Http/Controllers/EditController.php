<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditController extends Controller
{
    public function update(Request $request, ToDo $todo){
        // Pastikan user hanya bisa update todo miliknya
        if($todo->user_id !== Auth::id()){
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'deadline' => 'nullable|date',
            'status' => 'required|in:pending,late,completed',
        ], [
            'title.required' => 'Judul todo wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'description.max' => 'Deskripsi maksimal 1000 karakter',
            'deadline.date' => 'Format tanggal tidak valid',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ];

        // Set completed_at when status is completed
        if($request->status === 'completed') {
            $updateData['completed_at'] = now();
        } else {
            $updateData['completed_at'] = null;
        }

        $todo->update($updateData);

        return redirect()->route('home')->with('success', 'Todo berhasil diperbarui!');
    }

    //untuk toggle status todo
    public function toggleStatus(ToDo $todo){
        // Pastikan user hanya bisa toggle todo miliknya
        if($todo->user_id !== Auth::id()){
            abort(403);
        }

        $newStatus = $todo->status === 'completed' ? 'pending' : 'completed';
        $updateData = ['status' => $newStatus];

        if($newStatus === 'completed') {
            $updateData['completed_at'] = now();
        } else {
            $updateData['completed_at'] = null;
        }

        $todo->update($updateData);

        return redirect()->route('home')->with('success', 'Status todo berhasil diperbarui!');
    }
}
