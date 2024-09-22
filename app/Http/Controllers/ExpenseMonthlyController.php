<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ExpenseMonthlyController extends Controller
{
    public function index()
    {
        $response = Http::withToken(session('jwt_token'))->get('http://expenses-monthly-service/api/expenses');
        $expenses = $response->json();
        return view('expensesMonthly.index', compact('expenses'));
    }

    public function create()
    {
        return view('expensesMonthly.create');
    }

    public function store(Request $request)
    {
        try {
            $response = Http::withToken(session('jwt_token'))->post('http://expenses-monthly-service/api/expenses', [
                'date' => $request->input('date'),
                'name' => $request->input('name'),
                'amount' =>  $request->input('amount')
            ]);
    
            $responseData = $response->json();
    
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Expense added successfully!');
            } else {
                $errorMessage = $responseData['error'] ?? 'Failed to add expense.';
                return redirect()->back()->with('error', $errorMessage);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $th->getMessage());
        }
    }
    

    public function update()
    {
        $response = Http::withToken(session('jwt_token'))->put('http://expenses-monthly-service/api/expenses');
        $users = $response->json();
    }

    public function delete($id)
    {
        $response = Http::withToken(session('jwt_token'))->delete("http://expenses-monthly-service/api/expenses/$id");
        
        Log::info('Delete response from Node API:', ['response' => $response->body()]);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Expense deleted successfully.');
        } else {
            Log::error('Failed to delete expense', ['status' => $response->status(), 'response' => $response->body()]);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    
}
