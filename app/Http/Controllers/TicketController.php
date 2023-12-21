<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SupportDepartment;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Reply;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TicketController extends Controller
{



    public function adminticketmessagelist()
    {
        $ticket = Ticket::all();
        return view('backend.admin.support.ticketlist', compact('ticket'));
    }

    public function adminticketreply()
    {
        $ticket = Ticket::all();
        return view('backend.admin.support.replyPage', compact('ticket'));
    }
    public function ticketmessageshowadmin($id)
    {
        $data = Reply::with('assignUser', 'assignAdmin')->where('ticket_id', $id)->orderBy('id', 'asc')->get();
        return response()->json($data);
    }
    public function adminticketreplyPost(Request $request)
    {
       
        $fileName = null;
        if ($request->hasFile('attachment')) {
            $fileName = time() . '.' . $request->file('attachment')->getclientOriginalExtension();
            $request->file('attachment')->move(public_path('/uploads/support/'), $fileName);
            $fileName = "/uploads/support/" . $fileName;
        }
        $savemessage = new Reply();
        $savemessage->message = $request->message;
        $savemessage->ticket_id = $request->ticket_id;
        $savemessage->assign_id_admin = authUser()->id;
        $savemessage->attachment =  $fileName;
        $savemessage->save();
        return back();
    }


    public function ticketDeleteAdmin($id)
    {

         Ticket::find($id)->delete();
         return response()->json(['message' => 'Task deleted successfully']);    }




    //front

    public function ticketCreateSchool()
    {
        $seoTitle = 'Support Create';
        $seoDescription = 'Support Create';
        $seoKeyword = 'Support Create';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $data = SupportDepartment::all();
        $data1 = School::where('id', authUser()->id)->first();
        return view('frontend.school.support.TicketCreate', compact('data', 'data1','seo_array'));
    }
    public function  tokenReplyPage()
    {
        $seoTitle = 'Support Reply';
        $seoDescription = 'Support Reply';
        $seoKeyword = 'Support Reply';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $ticket = Ticket::where('school_id',authUser()->id)->get();

        return view('frontend.school.support.TicketReply', compact('ticket','seo_array'));
    }
    public function  tokenCreatePost(Request $request)
    {


        $fileName = null;
        if ($request->hasFile('attachment')) {
            $fileName = time() . '.' . $request->file('attachment')->getclientOriginalExtension();
            $request->file('attachment')->move(public_path('/uploads/support/'), $fileName);
            $fileName = "/uploads/support/" . $fileName;
        }
        $ticket = Ticket::create([

            'token' => Str::random(5),
            'school_id'=>authUser()->id,
            'name' => authUser()->school_name,
            'email' => authUser()->email,
            'subject' => $request->input('subject'),
            'department_id' => $request->department_id,
            'priority' => $request->input('priority')
        ]);

        $message = new Reply();
        $message->message = $request->message;
        $message->assign_id_user = authUser()->id;
        $message->ticket_id = $ticket->id;
        $message->attachment =  $fileName;

        $ticket->replies()->save($message);
        return redirect()->route('token.reply.page');
    }

    //src="'+ item.assign_user.school_logo +'" 
    public function tokenreplyPost(Request $request)
    {
        $fileName = null;
        if ($request->hasFile('attachment')) {
            $fileName = time() . '.' . $request->file('attachment')->getclientOriginalExtension();
            $request->file('attachment')->move(public_path('/uploads/support/'), $fileName);
            $fileName = "/uploads/support/" . $fileName;
        }
        $savemessage = new Reply();
        $savemessage->message = $request->message;
        $savemessage->ticket_id = $request->ticket_id;
        $savemessage->assign_id_user = authUser()->id;
        $savemessage->attachment =  $fileName;
        $savemessage->save();
        return response()->json(['message' => 'Reply Send']);

    }
    public function  tokenLoadShow($id)
    {

        $data = Reply::with('ticket', 'assignUser', 'assignAdmin')->where('ticket_id', $id)->orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function ticketDeleteSchool($id)
    {

         Ticket::find($id)->delete();
        return response()->json(['message' => 'Task deleted successfully']);    
    }

    public function ticketlatestMessageSchool($id){
       Reply::where('ticket_id',$id)->latest()->first();
     return response()->json(['message' => 'Message Found']);    

    }


    public function supportDeptDel($id)
    {
        $data = SupportDepartment::find($id)->delete();
        return back();
    }
    public function   supportDCreate()
    {
        $seoTitle = 'Support Reply';
        $seoDescription = 'Support Reply';
        $seoKeyword = 'Support Reply';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $dept = SupportDepartment::all();
        return view('frontend.school.support.supportDepartment', compact('dept','seo_array'));
    }

    public function   supportDCreatePost(Request $request)
    {
        $request->validate([
            'department' => 'required',
        ]);
        $support = new SupportDepartment();
        $support->department = $request->department;

        $support->save();
        Alert::success('Department Created Succesfully', 'Success Message');
        return back();
    }


}
