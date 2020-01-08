<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;


class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
    */

    private $client_id = "MT1JQ13Y4QES2ZZIYLBNK55SVAP14AAEKCZC5G2LHP4M5EFG";
    private $client_secret = "G3IXYSL4AJWB5EZ5D2CSL0KJO05PO1VRYP12NH2IQLLLKE5G";
    private $version = "20200108";

    public function get_categories()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.foursquare.com/v2/venues/categories?client_id='.$this->client_id.'&client_secret='.$this->client_secret.'&v='.$this->version);
        
        return $this->json([
            'categories' => $response->getContent(),
        ]);
    }

    public function get_list(Request $request)
    {

        $near = $request->query->get('near');
        $query = $request->query->get('query');
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.foursquare.com/v2/venues/explore?near='.$near.'&query='.$query.'&client_id='.$this->client_id.'&client_secret='.$this->client_secret.'&v='.$this->version);
        return $this->json([
            'list' => $response->getContent(),
        ]);
    }
    
}
