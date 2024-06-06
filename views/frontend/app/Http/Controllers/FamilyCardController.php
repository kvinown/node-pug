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

        $response = $this->client->request('POST', '/api/fam-card/store', [
                'json' => $request->all()
        ]);

        return redirect(route('fam-card'))->with('success', 'Data berhasil ditambah');
    }





    public function edit($id)
    {
        $response = $this->client->request('GET', "/api/fam-card/edit/{$id}");
        $familyCard = json_decode($response->getBody()->getContents());
        $familyCardData = $familyCard->data;

        return view('family_card.edit', compact('familyCardData'));
    }

    public function update(Request $request)
    {
        $response = $this->client->request('POST', "/api/fam-card/update", [
            'json' => $request->all()
        ]);

        return redirect(route('fam-card'))->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $response = $this->client->request('GET', "/api/fam-card/delete/{$id}");

        return redirect(route('fam-card'))->with('success', 'Data berhasil dihapus');
    }
}
