<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\User;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index() {
        $user = User::whereHas('info')->with('info')->where('id', auth()->user()->id)->first();
        if($user) {
            $info = $user->first()->info;
        }else {
            $info = '';
        }

        return view('admin.account.index')->with([
            'info' => $info
        ]);
    }

    public function store(AccountRequest $request) {
        $user = User::find(auth()->user()->id);
        $chehckuser = User::whereHas('info')->where('id', auth()->user()->id)->first();
     
        DB::beginTransaction();

        try {
            $userinfo = new UserInfo();
            $userinfo->user_id = auth()->user()->id;
            $userinfo->mobile = $request->mobile;
            $userinfo->address = $request->address;
            if($chehckuser == null){
                $user->info()->save($userinfo);
            }else {
                $user->info()->update([
                    'mobile' => $request->mobile,
                    'address' => $request->address
                ]);
            }

            DB::commit();
    
            return redirect()->back()->with('message', 'Your info has been updated');
        }catch (Exception $e) {
            DB::rollback();
        
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
