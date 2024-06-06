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
            $familyCardDatas = $familyCards->data;
            return view('family_card.index', compact('familyCardDatas'));
        }
    }

    public function create()
    {
        return view('family_card.create');
    }

    public function store(Request $request)
    {
        // Debugging the request data
        // dd($request->all());

        try {
            $response = $this->client->request('POST', '/api/fam-card/store', [
                'json' => $request->all()
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle the exception if the request fails
            return redirect()->back()->with('error', 'Failed to send data to API');
        }

        return redirect(route('fam-card'))->with('success', 'Data berhasil ditambah');
    }





    public function edit($id)
    {
//        dd($id);
        try {
            $response = $this->client->request('GET', "/api/fam-card/edit/{$id}");
            $familyCard = json_decode($response->getBody()->getContents());
            $familyCardData = $familyCard->data;

            return view('family_card.edit', compact('familyCardData'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch data from API');
        }
    }

    public function update(Request $request)
    {
        try {
            $response = $this->client->request('POST', "/api/fam-card/update", [
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
            $response = $this->client->request('GET', "/api/fam-card/delete/{$id}");

            return redirect('/fam-card')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal menghapus data melalui API
            return back()->with('error', 'Failed to delete data through API');
        }
    }
}
