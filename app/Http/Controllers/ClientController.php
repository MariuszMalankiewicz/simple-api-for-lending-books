<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all(['first_name', 'last_name']);
        return response()->json($clients);
    }

    public function show($id)
    {
        $client = Client::with('books')->findOrFail($id);
        
        return response()->json($client);
    }
}
