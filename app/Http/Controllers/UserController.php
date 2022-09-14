<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('number_customers', 'desc')->paginate(20);
        return view('admin.data_user', compact('users'));
    }

    public function __construct()
    {
    //     $this->middleware('auth');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (auth()->attempt($credentials)) {
        return redirect()->intended('/')->withSuccess('Signed in');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }


    public function form_user($id = 0)
    {
        if ($id != 0) {
            $user = Users::where('u_id', $id)->first();
            return view('admin/add_data', compact('user', 'id'));
        }
        return view('admin/add_data');
    }


    public function adduser(Request $request, $id)
    {

        // $validator = Validator::make($request->all(), [
        //     'number_customers' => 'required',
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'age' => 'required',
        //     'tel' => 'required',
        //     'cid' => 'required',
        //     'username' => 'required',
        //     'passwoed' => 'required'
        // ]);
        // if ($validator->fails()) {
        //     return back()->with([
        //                 'error' => $validator->errors()
        //             ]);
        // }
        DB::beginTransaction();
        if ($id != 0) {
            $user = Users::where('u_id', $id)->first();
        } else {
            $check = User::where('number_customers', $request->number_customers)->count();
            if ($check > 0) {
                return back();
            }
            $user = new User;
        }
        $user->number_customers = $request->input('number_customers');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->age = $request->input('age');
        $user->tel = $request->input('tel');
        $user->cid = $request->input('cid');
        $user->username = $request->input('username');
        $user->email = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        DB::commit();

        return redirect()->route('data_user.index')->with(['success' => true, 'data' => $request->all()]);
    }

    public function del_user(Request $request)
    {
        DB::beginTransaction();
        User::where('u_id', $request->id)->delete();
        DB::commit();

        return response()->json(['status' => true]);
    }
}
