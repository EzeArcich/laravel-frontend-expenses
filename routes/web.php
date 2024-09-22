<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseMonthlyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/api/login', function (Request $request) {
    try {
        $response = Http::post('http://lumen-backend.test/api/login', [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        if ($response->successful()) {
            $token = $response->json('token');
            Session::put('jwt_token', $token);
            return redirect('/users')->with('success', 'User logged in successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to log in.');
        }
    } catch (\Throwable $th) {
        Log::error($th->getMessage());
    }
});

Route::get('/', function () {
    return view('users.index');
})->middleware('checkAuth');

Route::get('/login', function () {
    return view('auth.login');
});


Route::post('/api/logout', function (Request $request) {
    $request->session()->forget('jwt_token');
    return redirect('/login')->with('success', 'Has cerrado sesión exitosamente.');
});



// UserController
Route::get('/users', [UserController::class, 'index'])->middleware('checkAuth');
Route::get('/create-user', [UserController::class, 'create'])->middleware('checkAuth');
Route::post('/store-user', [UserController::class, 'store'])->middleware('checkAuth');
Route::put('/update-user', [UserController::class, 'update'])->middleware('checkAuth');
Route::delete('/delete-user/{id}', [UserController::class, 'delete'])->middleware('checkAuth');

//ExpenseController
Route::get('/expenses', [ExpenseController::class, 'index']);
Route::get('/create-expense', [ExpenseController::class, 'create']);
Route::post('/store-expense', [ExpenseController::class, 'store']);
Route::put('/update-expense', [ExpenseController::class, 'update']);
Route::delete('/delete-expense/{id}', [ExpenseController::class, 'delete']);

// ExpenseMonthlyController
Route::get('/expenses-monthly', [ExpenseMonthlyController::class, 'index']);
Route::get('/create-expense-monthly', [ExpenseMonthlyController::class, 'create']);
Route::post('/store-expense-monthly', [ExpenseMonthlyController::class, 'store']);
Route::put('/update-expense-monthly', [ExpenseMonthlyController::class, 'update']);
Route::delete('/delete-expense-monthly/{id}', [ExpenseMonthlyController::class, 'delete']);



