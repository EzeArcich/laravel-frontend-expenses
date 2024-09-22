<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ExpenseController extends Controller
{
    public function index()
    {
        $response = Http::withToken(session('jwt_token'))->get('http://expenses-service/api/expenses');
        $expenses = $response->json();
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        try {

            $response = Http::withToken(session('jwt_token'))->post('http://expenses-service/api/expenses', [
                'date' => $request->input('date'),
                'name' => $request->input('name'),
                'amount' =>  $request->input('amount')
            ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Expense added successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to add expense.');
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function update()
    {
        $response = Http::withToken(session('jwt_token'))->put('http://expenses-service/api/expenses');
        $users = $response->json();
        // Agrega la lógica para actualizar usuarios aquí
    }

    public function delete($id)
    {
        $response = Http::withToken(session('jwt_token'))->delete("http://expenses-service/api/expenses/$id");
        
        // Agrega esto para depurar
        Log::info('Delete response from Node API:', ['response' => $response->body()]);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Expense deleted successfully.');
        } else {
            Log::error('Failed to delete expense', ['status' => $response->status(), 'response' => $response->body()]);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    
}
