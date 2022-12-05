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
        <button class="btn btn-primary" data-toggle="modal" data-target="#newEmployee">Add Employee +</button>
    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-striped">

                <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">-</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $i => $user)
                    <tr>
                        <td>{{$i +1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            <button class="btn btn-success assign-btn" data-toggle="modal" data-target="#assign-customer">+ Assign</button>
                            <span class="d-none">{{$user->id}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @section('modals')

        <div class="modal fade" id="newEmployee" tabindex="-1" role="dialog" aria-labelledby="newEmployee" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">New Employee</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('user.store')}}" method="post">

                            @csrf


                            <div class="form-group">
                              <label>Employee Name :</label>
                              <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Email :</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password :</label>
                                <input type="text" name="password" class="form-control">
                              </div>

                            <div class="form-group">
                                <label>Phone :</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Role :</label>
                                <select type="text" name="role" class="form-control">
                                    <option value="1">Employee</option>
                                    <option value="2">Admin</option>
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
                        <h5 class="modal-title">Assign a customer</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('user.assign')}}" method="post">

                            @csrf


                            <div class="form-group">
                                <label>Customer Name :</label>
                                <select name="customer_id" class="form-control">
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}} - {{$customer->email}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="user_id">
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
                let user_id = e.target.parentElement.querySelector('span').innerText;
                document.querySelector('[name=user_id]').value = user_id;
            }
        </script>
    @endsection
@endsection
