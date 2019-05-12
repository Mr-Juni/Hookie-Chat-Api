<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Groupmessage;


class GroupMessageController extends Controller
{

  public function __construct()
  {
     $this->middleware('auth');
  }


  public function groupMessagesIndex() {
    $user = Auth::user();

    $group_msg_pack = [];
    $group_msg_pack_rev = [];


    $group_msgs = DB::table('groupmessages')
                    ->orderBy('id', 'desc')
                    ->limit(20)
                    ->latest()
                    ->get();
    $group_msgs_revs = $group_msgs->reverse();


    foreach ($group_msgs as $group_msg) {

        $member = User::where('id', $group_msg->owner_id)->first();

        $packages = array($group_msg, $member);

       array_push($group_msg_pack, $packages);
    }

    foreach ($group_msgs_revs as $group_msgs_rev) {

        $member = User::where('id', $group_msgs_rev->owner_id)->first();

        $packages = array($group_msgs_rev, $member);

       array_push($group_msg_pack_rev, $packages);
    }



    return response()->json(['data' => ['success' => true, 'grp_msg' => $group_msg_pack, 'grp_msg_rev' => $group_msg_pack_rev, 'auth_user' => $user->id]], 200);
  }


  public function groupMessages(Request $request) {
    $user = Auth::user();

    $attribute = $this->validate($request, [
        'offset' => 'required'
      ]);

    $offset = $request->input('offset');

    $group_msg_pack = [];

    $group_msgs = DB::table('groupmessages')
                            ->offset($offset)
                            ->orderBy('id', 'desc')
                            ->limit(20)
                            ->latest()
                            ->get();

    foreach ($group_msgs as $group_msg) {

        $member = User::where('id', $group_msg->owner_id)->first();

        $packages = array($group_msg, $member);

       array_push($group_msg_pack, $packages);
    }

    $new_offset = $offset + 20; 

    return response()->json(['data' => ['success' => true, 'grp_msg' => $group_msg_pack, 'auth_user' => $user->id, 'new_offset' => $new_offset]], 200);
  }

  public function store(Request $request, User $user, Groupmessage $message) {
  	$user = Auth::user();

	$attribute = $this->validate($request, [
		'message' => 'required'
	]);

		$message->owner_id = $user->id;
        $message->text = $request->input('message');
        $message->save();

        event(new MessageSent($message, $user));
        return response()->json(['data' => ['success' => true, 'message' => 'Message Sent']], 201);
    }

}
