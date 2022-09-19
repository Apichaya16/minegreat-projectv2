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
            'cid.regex' => 'รูปแบบหมายเลขบัตรประชาชน x-xxxx-xxxxx-xx-x และต้องเป็นตัวเลขและ "-" เท่านั้น',
            'cid.string' => 'หมายเลขบัตรประชาชนต้องเป็นตัวเลขและ "-" เท่านั้น',
            'cid.max' => 'หมายเลขบัตรประชาชนรวมเครื่องหมาย "-" ต้องไม่เกิน 17 ตัวอักษร'
        ];
        $request->validate([
            'cid' => 'string|max:17|regex:/([1-9]{1})-([1-9]{4})-([1-9]{5})-([1-9]{2})-([1-9]{1})/'
        ], $msg);

        try {
            DB::beginTransaction();
            User::where('u_id', $userId)->update($request->all());
            DB::commit();

            $html = $this->renderTable();

            return response()->json(['status' => true, 'html' => $html]);
            // return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['status' => false, 'html' => null], $th->getCode());
        }
    }

    public function detroy($userId)
    {
        try {
            DB::beginTransaction();
            User::where('u_id', $userId)->delete();
            DB::commit();

            $html = $this->renderTable();

            return response()->json(['status' => true, 'html' => $html]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['status' => false, 'html' => null], $th->getCode());
        }
    }

    protected function renderTable()
    {
        $users = User::where('role_id', '>', 100)->get();
        $html = view('admin.register-customer.table.user-table', compact('users'))->render();
        return $html;
    }
}
