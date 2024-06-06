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
}
