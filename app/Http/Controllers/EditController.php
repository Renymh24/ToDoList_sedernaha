<?php

namespace App\Http\Controllers;
use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EditController extends Controller
{
    public function update(Request $request, ToDo $todo){
        // Pastikan user hanya bisa update todo miliknya
        if($todo->user_id !== Auth::id()){
            abort(403);
        }

        // Log data sebelum update
        $oldData = [
            'title' => $todo->title,
            'description' => $todo->description,
            'deadline' => $todo->deadline,
            'status' => $todo->status,
        ];
        //validasi error messages
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'deadline' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,late,completed',
        ], [
            'title.required' => 'Judul todo wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'description.max' => 'Deskripsi maksimal 1000 karakter',
            'deadline.required' => 'Deadline wajib diisi',
            'deadline.date' => 'Format tanggal tidak valid',
            'deadline.after_or_equal' => 'Tanggal deadline tidak boleh kurang dari hari ini',
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

        // Log update task
        Log::info('Task updated successfully', [
            'task_id' => $todo->id,
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'old_data' => $oldData,
            'new_data' => [
                'title' => $todo->title,
                'description' => $todo->description,
                'deadline' => $todo->deadline,
                'status' => $todo->status,
            ],
            'timestamp' => now()->toDateTimeString()
        ]);

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

        $oldStatus = $todo->status;
        $todo->update($updateData);

        // Log toggle status
        Log::info('Task status toggled', [
            'task_id' => $todo->id,
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'title' => $todo->title,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'timestamp' => now()->toDateTimeString()
        ]);

        return redirect()->route('home')->with('success', 'Status todo berhasil diperbarui!');
    }
}
