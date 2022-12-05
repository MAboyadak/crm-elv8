<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $rules = [];

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function all(){
        $customers = Customer::all();
        $users = User::all();
        return view('customers.all',compact('customers','users'));
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), ['name' => ['required', 'string', 'max:255'],]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        // dd($request);
        // return;
        $new_customer = new Customer();
        $new_customer->name = $request->name;
        $new_customer->phone = $request->phone;
        $new_customer->assigned_employee_id = $request->employee_id;

        if($new_customer->save()){
            return redirect()->back()->with('success','The Customer has been added successfully');
        }

    }


}
