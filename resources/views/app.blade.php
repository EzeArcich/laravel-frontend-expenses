<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>App blade</title>
</head>
<body class="bg-dark">
    <nav class="navbar bg-dark navbar-expand-lg border-bottom border-info" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Life</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/users">Show all users</a></li>
                            <li><a class="dropdown-item" href="/create-user">Create Users</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Expenses
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/expenses">Show all expenses</a></li>
                            <li><a class="dropdown-item" href="/create-expense">Add expense</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Monthly Expenses
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/expenses-monthly">Show all expenses</a></li>
                            <li><a class="dropdown-item" href="/create-expense-monthly">Add monthly expense</a></li>
                        </ul>
                    </li>
                </ul>
                <form action="/api/logout" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-outline-danger" type="submit">Log out</button>
                </form>
            </div>
        </div>

    </nav>

    <!-- Contenido de las vistas -->
    <div class="container mt-4">
        @yield('content')
    </div>

</body>
</html>

