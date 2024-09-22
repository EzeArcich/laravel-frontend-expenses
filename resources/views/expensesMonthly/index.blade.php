@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Usuarios</h1>

            <table class="table table-dark">
                <thead">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Ammount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $exp)
                        <tr>
                            <th scope="row">{{$exp['id']}}</th>
                            <td>{{$exp['name']}}</td>
                            <td>{{$exp['amount']}}</td>
                            <td>{{$exp['date']}}</td>
                            <td>
                                <form action="/delete-expense-monthly/{{ $exp['id'] }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

@endsection