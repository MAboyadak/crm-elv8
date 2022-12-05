@extends('layouts.app')

@section('content')


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif


    <div class="mb-2" style="text-align: right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newCustomer">Add Customer +</button>
    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-striped">

                <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Assigned Employee</th>
                <th scope="col">-</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customers as $i => $customer)
                    <tr>
                        <td>{{$i +1}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->employee? $customer->employee->name ." # ". $customer->employee->email : ''}}</td>
                        <td>
                            <button class="btn btn-success assign-btn" data-toggle="modal" data-target="#assign-customer">+ Assign</button>
                            <span class="d-none">{{$customer->id}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @section('modals')

        <div class="modal fade" id="newCustomer" tabindex="-1" role="dialog" aria-labelledby="newCustomer" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">New Employee</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('customer.store')}}" method="post">

                            @csrf


                            <div class="form-group">
                              <label>Customer Name :</label>
                              <input type="text" name="name" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>Phone :</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Assigned Employee :</label>
                                <select name="employee_id" class="form-control">
                                    <option value="" selected>-</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}-{{$user->email}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div style="text-align: center; margin-top:15px">
                                <button type="submit" class="btn btn-primary">Add Employee</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="assign-customer" tabindex="-1" role="dialog" aria-labelledby="assign-customer" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Assign To Employee :</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('user.assign')}}" method="post">

                            @csrf


                            <div class="form-group">
                                <label>Customer Name :</label>
                                <select type="text" name="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="customer_id">
                            </div>

                            <div style="text-align: center; margin-top:15px">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection

    @section('scripts')
        <script>
            let allAssignBtns = document.querySelectorAll('.assign-btn');
            allAssignBtns.forEach(btn => {
                btn.addEventListener('click',assignCustomer);
            });

            function assignCustomer(e){
                let customer_id = e.target.parentElement.querySelector('span').innerText;
                document.querySelector('[name=customer_id]').value = customer_id;
            }
        </script>
    @endsection
@endsection
