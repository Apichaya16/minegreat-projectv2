<?php

namespace App\Http\Controllers;

use App\Http\Utils\CodeUtil;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $users = User::where('role_id', '>', 100)->get();
        return view('admin.register-customer.index', compact('users'));
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


    public function create()
    {
        $nextCode = CodeUtil::getLastCode('account');
        return view('admin.register-customer.create', compact('nextCode'));
    }


    public function store(Request $request)
    {
        $msg = [
            'cid.regex' => 'รูปแบบหมายเลขบัตรประชาชน x-xxxx-xxxxx-xx-x',
            'cid.string' => 'หมายเลขบัตรประชาชนต้องเป็นตัวเลขเท่านั้น'
        ];
        $request->validate([
            'cid' => 'string|regex:/([1-9]{1})-([1-9]{4})-([1-9]{5})-([1-9]{2})-([1-9]{1})/'
        ], $msg);

        DB::beginTransaction();
        $code = CodeUtil::generateCode('account');
        $user = new User;
        $user->number_customers = $code;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->age = $request->input('age');
        $user->tel = $request->input('tel');
        $user->cid = $request->input('cid');
        $user->username = $code;
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        DB::commit();

        return redirect()->route('admin.user.index');
    }

    public function edit($userId)
    {
        $user = User::where('u_id', $userId)->first();
        return view('admin.register-customer.update', compact('user'));
    }

    public function update(Request $request, $userId)
    {
        $msg = [
            'cid.regex' => 'รูปแบบหมายเลขบัตรประชาชน x-xxxx-xxxxx-xx-x',
            'cid.string' => 'หมายเลขบัตรประชาชนต้องเป็นตัวเลขเท่านั้น'
        ];
        $request->validate([
            'cid' => 'string|regex:/([1-9]{1})-([1-9]{4})-([1-9]{5})-([1-9]{2})-([1-9]{1})/'
        ], $msg);

        DB::beginTransaction();
        $user = User::where('u_id', $userId)->first();
        $user->number_customers = $request->input('number_customers');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->age = $request->input('age');
        $user->tel = $request->input('tel');
        $user->cid = $request->input('cid');
        $user->save();
        DB::commit();

        return redirect()->route('admin.user.index');
    }

    public function detroy(Request $request)
    {
        DB::beginTransaction();
        User::where('u_id', $request->id)->delete();
        DB::commit();

        return response()->json(['status' => true]);
    }
}
