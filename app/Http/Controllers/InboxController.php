<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    /* =====================
     | INBOX MASUK
     ===================== */
    public function index()
    {
        $userId = Auth::id();

        $inboxes = DB::table('inboxes as i')
            ->join('users as s', 'i.sender_id', '=', 's.id')
            ->select(
                'i.id',
                'i.subject',
                'i.is_read',
                'i.created_at',
                's.name as sender_name'
            )
            ->where('i.receiver_id', $userId)
            ->orderBy('i.created_at', 'DESC')
            ->get();

        return view('Inbox.index', compact('inboxes'));
    }

    /* =====================
     | FORM BUAT PESAN
     ===================== */
    public function create()
    {
        $users = DB::table('users')
            ->where('id', '!=', Auth::id())
            ->get();

        return view('Inbox.create', compact('users'));
    }

    /* =====================
     | SIMPAN PESAN
     ===================== */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject'     => 'required|string|max:255',
            'message'     => 'required|string',
        ]);

        DB::table('inboxes')->insert([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'subject'     => $request->subject,
            'message'     => $request->message,
            'is_read'     => 0,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);


        toastr()->success('success', 'Message sent successfully');
        return redirect()->route('inbox.index');
          
    }

    /* =====================
     | SHOW PESAN
     ===================== */
    public function show($id)
    {
        $userId = Auth::id();

        $message = DB::table('inboxes as i')
            ->join('users as s', 'i.sender_id', '=', 's.id')
            ->join('users as r', 'i.receiver_id', '=', 'r.id')
            ->select(
                'i.*',
                's.name as sender_name',
                's.email as sender_email',
                'r.name as receiver_name',
                'r.email as receiver_email'
            )
            ->where('i.id', $id)
            ->where(function ($q) use ($userId) {
                $q->where('i.sender_id', $userId)
                  ->orWhere('i.receiver_id', $userId);
            })
            ->first();

        if (!$message) {
            abort(404);
        }

        // tandai dibaca
        if ($message->receiver_id == $userId && !$message->is_read) {
            DB::table('inboxes')->where('id', $id)->update(['is_read' => 1]);
        }

        return view('Inbox.show', compact('message'));
    }

    /* =====================
     | DELETE PESAN
     ===================== */
    public function destroy($id)
    {
        DB::table('inboxes')
            ->where('id', $id)
            ->where(function ($q) {
                $q->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
            })
            ->delete();

         toastr()->success('success', 'Message deleted');
        return redirect()->route('inbox.index');
           
    }
}
