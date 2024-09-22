@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-white">Add Expense</h1>

            <div class="card border-info">
                <div class="card-header border-info bg-dark text-white">
                    Expense data
                </div>
                <div class="card-body p-0">
                    <form class="p-5 bg-dark text-white align-items-center" action="/store-expense" method="POST">
                        @csrf
                        <div class="col-6">
                            <label for="exampleInputPassword1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control"aria-describedby="emailHelp">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputPassword1" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control">
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