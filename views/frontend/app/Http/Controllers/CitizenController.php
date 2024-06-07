<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8888']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/api/citizen');
        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $citizens = json_decode($response->getBody()->getContents());
            $citizenDatas = $citizens->data;
            return view('citizen.index', compact('citizenDatas'));
        }
    }
    public function create(){
        $response = $this->client->request('GET', '/api/fam-card');

        $familyCards = json_decode($response->getBody()->getContents());
        $familyCardDatas = $familyCards->data;
//        dd($familyCardDatas);
        return view('citizen.create', compact('familyCardDatas'));
    }
    public function store(Request $request)
    {
        try {
            $response = $this->client->request('POST', '/api/citizen/store', [
                'json' => $request->all()
            ]);

            $responseData = json_decode($response->getBody(), true);

            if ($responseData['success']) {
                return redirect(route('citizen'))->with('success', 'Data berhasil ditambah');
            } else {
                return redirect(route('citizen'))->with('error', 'Terjadi kesalahan saat menambah data');
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseData = json_decode($responseBodyAsString, true);

            // Check if the error is due to a duplicate entry
            if (isset($responseData['error']) && strpos($responseData['error'], 'ER_DUP_ENTRY') !== false) {
                return redirect(route('citizen'))->with('error', 'Data penduduk sudah terdaftar, silahkan coba lagi.');
            }

            return redirect(route('citizen'))->with('error', 'Terjadi kesalahan saat menambah data');
        } catch (\Exception $e) {
            return redirect(route('citizen'))->with('error', 'Terjadi kesalahan saat menambah data');
        }
    }

    public function edit($nik)
    {
        $responseCit = $this->client->request('GET', "/api/citizen/edit/{$nik}");
        $citizen = json_decode($responseCit->getBody()->getContents());
        $citizenData = $citizen->data;

        $responseFam =  $this->client->request('GET', '/api/fam-card');
        $familyCards = json_decode($responseFam->getBody()->getContents());
        $familyCardDatas = $familyCards->data;

        return view('citizen.edit', compact('citizenData', 'familyCardDatas'));
    }
    public function update(Request $request)
    {
        $response = $this->client->request('POST', "/api/citizen/update", [
            'json' => $request->all()
        ]);

        return redirect(route('citizen'))->with('success', 'Data berhasil diubah');
    }

    public function destroy($nik)
    {
        $response = $this->client->request('GET', "/api/citizen/delete/{$nik}");

        return redirect(route('citizen'))->with('success', 'Data berhasil dihapus');
    }
}
