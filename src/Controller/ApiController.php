<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RoleRepository as EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;

class ApiController extends AbstractController
{
	public function __construct() {
	}
	
    /**
     * @Route("/api", name="api_put", methods={"PUT"})
     */
    public function apiPut(EntityManagerInterface $entityManager,Request $request,EntityRepository $entities)
    {
		$id = $request->query->get('id');
		$entity = $entities->findBy($id) or new Role();
		foreach($request->query->all() as $var => $val) {
		}
	}
	
    /**
     * @Route("/api", name="api_delete", methods={"DELETE"})
     */
    public function apiDelete(EntityManagerInterface $entityManager,Request $request,EntityRepository $entities)
    {
		$entity = $entities->findBy($request->query->get('id'));
		$entityManager->remove($entity);
		$entityManager->flush();
	}
	
    /**
     * @Route("/api", name="api_get", methods={"GET"})
     */
    public function index(Request $request,EntityRepository $entities)
    {
		$entities = $entities->findBy($request->query->all());
		//$filter = $request->query->all();
		//$jsonContent = $this->serializer->serialize($entities->findAll(), 'json');
		
        return $this->json(
			$entities
        );
    }
}

