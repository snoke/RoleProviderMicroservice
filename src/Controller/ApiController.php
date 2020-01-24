<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RoleRepository as EntityRepository;

use Symfony\Component\HttpClient\HttpClient;

class ApiController extends AbstractController
{
	public function __construct() {
	}
	
    /**
     * @Route("/api", name="api_index")
     */
    public function index(Request $request,EntityRepository $entities)
    {
		//$filter = $request->query->all();
		//$jsonContent = $this->serializer->serialize($entities->findAll(), 'json');
		
        return $this->json([
			$entities->findAll(),
        ]);
    }
}
