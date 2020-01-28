<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RoleRepository as EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Role;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiController extends AbstractController
{
	public function __construct() {
	}
	
    /**
     * @Route("/api", name="api_search", methods={"GET"})
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
	
    /**
     * @Route("/api/{id}", name="api_patch", methods={"Patch"})
     */
    public function apiPatch(EntityManagerInterface $entityManager,Request $request,EntityRepository $entities,$id)
    {
		die('patch');
	}
	
    /**
     * @Route("/api/{id}", name="api_putget", methods={"put"})
     */
    public function apiPut(EntityManagerInterface $entityManager,Request $request,EntityRepository $entities,$id)
    {
		$encoders = [new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];
		$serializer = new Serializer($normalizers, $encoders);

		$entity = $serializer->deserialize($request->query->all() ,'App\Entity\Role','json');
		
		/*
		$id = $request->query->get('id');
		$name = $request->query->get('name');
		$entity= ($id==null?new Role():$entities->findBy($id));
		$entity->setName($name);
		*/
		$entityManager->persist($entity);
		$entityManager->flush();
		die('entity with id #' . $entity->getId() . ' added');
	}
	
    /**
     * @Route("/api/{id}", name="api_delete", methods={"DELETE"})
     */
    public function apiDelete(EntityManagerInterface $entityManager,Request $request,EntityRepository $entities,$id)
    {
		$entity = $entities->findOneBy(['id' => $request->query->get('id')]);
		$entityManager->remove($entity);
		$entityManager->flush();
		die('deleted');
	}
	
    /**
     * @Route("/api/{id}", name="api_get", methods={"GET"})
     */
    public function apiGet(Request $request,EntityRepository $entities,$id)
    {
		$entities = $entities->findOneBy($request->query->all());
		//$filter = $request->query->all();
		//$jsonContent = $this->serializer->serialize($entities->findAll(), 'json');
		
        return $this->json(
			$entities
        );
    }
}

