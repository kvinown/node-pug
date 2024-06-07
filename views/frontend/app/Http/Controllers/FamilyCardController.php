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
        try {
            $response = $this->client->request('POST', '/api/fam-card/store', [
                'json' => $request->all()
            ]);

            $responseData = json_decode($response->getBody(), true);

            if ($responseData['success']) {
                return redirect(route('fam-card'))->with('success', 'Data berhasil ditambah');
            } else {
                return redirect(route('fam-card'))->with('error', 'Terjadi kesalahan saat menambah data');
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Check if the error is due to a duplicate entry
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('fam-card'))->with('error', 'Nomor Kartu Keluarga sudah terdaftar, silahkan diganti dengan nomor yang lain');
            }

            return redirect(route('fam-card'))->with('error', 'Terjadi kesalahan saat menambah data');
        } catch (\Exception $e) {
            return redirect(route('fam-card'))->with('error', 'Terjadi kesalahan saat menambah data');
        }
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
