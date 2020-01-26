<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Parsedown;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
	$client = HttpClient::create();
	$response = $client->request('GET', "https://raw.githubusercontent.com/snoke/RoleProviderMicroservice/master/README.md");
	$content = $response->getContent();
	$Parsedown = new Parsedown();
        return new Response($Parsedown->text($content));    
    }
}
