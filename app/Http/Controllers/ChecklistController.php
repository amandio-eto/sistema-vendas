<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
{
    public function toggle(Request $request, $id)
{
    

    DB::table('checklist')
        ->where('id', $id)
        ->update([
            'status_check' => $request->status_check
        ]);
     toastr()->success('Message','Successfully Filter data ETO Is ON');
     return back();

}


  public function offtoggle($id)
{
    $checklist = DB::table('checklist')->whereId(1);

    $checklist->update([
        "status_check" => 0

    ]);
    toastr()->success('Message','Successfully Filter data ETO Is OFF');
    return back();
}

}
