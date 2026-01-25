<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    

public function index(Request $request)
{
    $search = $request->search;

    $logs = DB::table('user_logs as ul')
        ->leftJoin('users as u', 'u.id', '=', 'ul.user_id')
        ->select(
            'ul.*',
            'u.name as user_name',
            'u.email as user_email'
        )
        ->when($search, function ($query) use ($search) {
            $query->where('u.name', 'like', "%$search%")
                  ->orWhere('u.email', 'like', "%$search%")
                  ->orWhere('ul.ip', 'like', "%$search%")
                  ->orWhere('ul.browser', 'like', "%$search%");
        })
        ->orderByDesc('ul.created_at')
        ->simplePaginate(10);

    return view('User_Logs.index', compact('logs', 'search'));
}

}
