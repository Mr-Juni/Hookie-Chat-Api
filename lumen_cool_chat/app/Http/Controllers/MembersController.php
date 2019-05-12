<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class MembersController extends Controller
{

  public function __construct()
  {
     $this->middleware('auth');
  }

  public function index() {
    $user = Auth::user();

    $all_members = User::where('id', '!=', $user->id)->get();

    $member_all = [];

    foreach ($all_members as $all_member) {

        $member = User::where('id', $all_member->id)->first();

           if ($member->isOnline()) {
                $presence = [
                    'onlinePresence' => true
                ];
            }else{
                $presence = [
                    'onlinePresence' => false
                ];
            }
       $packages = array($member, $presence);

       array_push($member_all, $packages);
    }

    return response()->json(['data' => ['success' => true, 'all_member' => $member_all]], 200);

  }

}
