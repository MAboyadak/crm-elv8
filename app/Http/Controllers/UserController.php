<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $rules = [];

    public function __construct()
    {
        $this->middleware('auth');

        $this->rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
        ];
    }

    public function all(){
        $customers = Customer::all();
        $users = User::all();

        return view('users.all',compact('users', 'customers'));
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        if(DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role_id' => $request->role,
                ]
            )){
            return redirect()->back()->with('success','The Employee has been added successfully');
        }

    }

    public function assign(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_id' => ['required'],
            'user_id' => ['required'],
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $customer = Customer::find($request->customer_id);
        // dd($customer);
        // return;
        if($customer){
            $customer->assigned_employee_id = $request->user_id;
            if($customer->save()){
                return redirect()->back()->with('success',"Customer has been assigned to the employee of id $request->user_id Successfully");
            }
        }

    }

}
