@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-white">Create User</h1>

            <div class="card border-info">
                <div class="card-header border-info bg-dark text-white">
                    User data
                </div>
                <div class="card-body p-0">
                    <form class="p-5 bg-dark text-white align-items-center" action="/store-user" method="POST">
                        @csrf
                        <div class="col-6">
                            <label for="exampleInputPassword1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control"aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="col-6">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="py-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection