<?php

namespace Tukmachev\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tukmachev\Shop\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(15);
        return view('shop::clients.index', compact('clients'));
    }

    public function create()
    {
        return view('shop::clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:shop_clients,email',
            'phone'       => 'nullable|string|max:50',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string|max:255',
            'country'     => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        Client::create($data);
        return redirect()->route('shop.clients.index')->with('success', 'Клиент создан.');
    }

    public function show(Client $client)
    {
        $client->load('orders');
        return view('shop::clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('shop::clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:shop_clients,email,' . $client->id,
            'phone'       => 'nullable|string|max:50',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string|max:255',
            'country'     => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $client->update($data);
        return redirect()->route('shop.clients.index')->with('success', 'Клиент обновлён.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('shop.clients.index')->with('success', 'Клиент удалён.');
    }
}
