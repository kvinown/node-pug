<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FamilyCardController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']); // Ganti URL dengan URL API Node.js Anda
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/fam-card');
        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $familyCards = json_decode($response->getBody()->getContents());
            return view('family_card.index', compact('familyCards'));
        }
    }

    public function create()
    {
        return view('family_card.create');
    }

    public function store(Request $request)
    {
        try {
            $response = $this->client->request('POST', '/api/fam-card', [
                'json' => $request->all()
            ]);

            return redirect('/fam-card')->with('success', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal menyimpan data melalui API
            return back()->with('error', 'Failed to store data through API');
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->request('GET', "/api/fam-card/{$id}");
            $familyCard = json_decode($response->getBody()->getContents());

            return view('family_card.edit', compact('familyCard'));
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal mengambil data dari API
            return back()->with('error', 'Failed to fetch data from API');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $response = $this->client->request('PUT', "/api/fam-card/{$id}", [
                'json' => $request->all()
            ]);

            return redirect('/fam-card')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal mengubah data melalui API
            return back()->with('error', 'Failed to update data through API');
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->client->request('DELETE', "/api/fam-card/{$id}");

            return redirect('/fam-card')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal menghapus data melalui API
            return back()->with('error', 'Failed to delete data through API');
        }
    }
}
