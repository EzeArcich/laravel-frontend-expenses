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
                    <form id="expense-form" class="p-5 bg-dark text-white align-items-center">
                        @csrf
                        <div class="col-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" required>
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
<div id="response-message"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#expense-form').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío normal del formulario

        const formData = {
            name: $('input[name="name"]').val(),
            amount: $('input[name="amount"]').val(),
            date: $('input[name="date"]').val(),
        };

        const token = "{{ session('jwt_token') }}";

        $.ajax({
            url: 'http://expenses-monthly-service/api/expenses',
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'Authorization': `Bearer ${token}`
            },
            data: JSON.stringify(formData),
            success: function(response) {
                $('#response-message').html('<div class="alert alert-success">Expense added successfully!</div>');
                setTimeout(() => {
                    location.reload();
                }, 2500);
            },
            error: function(xhr) {
                $('#response-message').html('<div class="alert alert-danger">Failed to add expense: ' + xhr.responseJSON.error + '</div>');
            }
        });
    });
});
</script>
@endsection