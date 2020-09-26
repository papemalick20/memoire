<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Var PropertyRepository
     */
    private $repository;
    /**
     * @Var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
        //$this->em = $em;
    }
    /**
     * @Route("/property", name="property.index")
     */

    public function index(): Response
    {
        $property = $this->repository->findAllVisible();

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }
}
