<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RoleRepository as EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Role;

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
		$name = $request->query->get('name');
		$entity= ($id==null?new Role():$entities->findBy($id));
		$entity->setName($name);
		$entityManager->persist($entity);
		$entityManager->flush();
		die('entity with id #' . $entity->getId() . ' added');
	}
	
    /**
     * @Route("/del", name="api_delete", methods={"get"})
     */
    public function apiDelete(EntityManagerInterface $entityManager,Request $request,EntityRepository $entities)
    {
		$entity = $entities->findOneBy(['id' => $request->query->get('id')]);
		$entityManager->remove($entity);
		$entityManager->flush();
		die('deleted');
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

