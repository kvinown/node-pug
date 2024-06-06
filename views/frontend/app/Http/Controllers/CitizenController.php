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
            return view('citizen.index', compact('citizens'));
        }
    }
    public function create(){
        return view('citizen.create');
    }
    public function store(Request $request)
    {
        $response = $this->client->request('POST', '/api/citizen/store', [
            'json' => $request->all()
        ]);
        return redirect(route('citizen'))->with('success', 'Data Berhasil ditambah');
    }
    public function edit($nik)
    {
        $response = $this->client->request('GET', "/api/citizen/edit/{$nik}");
        $citizen = json_decode($response->getBody()->getContents());
        $citizenData = $citizen->data;

        return view('citizen.edit', compact('citizenData'));
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
