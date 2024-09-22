<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $response = Http::withToken(session('jwt_token'))->get('http://lumen-backend.test/api/users');
        $users = $response->json();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        try {
            $hashedPassword = Hash::make($request->input('password'));

            $response = Http::withToken(session('jwt_token'))->post('http://lumen-backend.test/api/store-users', [
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'password' => $hashedPassword
            ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'User created successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to create user.');
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function update()
    {
        $response = Http::withToken(session('jwt_token'))->put('http://lumen-backend.test/api/users');
        $users = $response->json();
        // Agrega la lógica para actualizar usuarios aquí
    }

    public function delete($id)
    {
        $response = Http::withToken(session('jwt_token'))->delete("http://lumen-backend.test/api/delete-users/$id");
        
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Usuario eliminado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el usuario.');
        }
    }
}
