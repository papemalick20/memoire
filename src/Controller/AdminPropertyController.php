<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
//use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PropertyRepository;
//use Doctrine\ORM\EntityManagerInterface;

class AdminPropertyController extends AbstractController
{
  /**
   * @var PropertyRepository
   */
  private $repository;
  /**
   *Manager
   * @var ObjectManager
   */
  private $manager;
  public function __construct(PropertyRepository $repository)
  {
    //$this->manager= $manager;
    $this->repository = $repository;
  }

  /**
   * @Route("/admin", name="admin_property")
   */
  public function index(): Response
  {
    $properties = $this->repository->findAll();
    return $this->render('admin_property/index.html.twig', [
      'properties' => $properties
    ]);
  }
  /**
   * @Route("/admin/property/create", name="admin.property.new")
   */
  public function new(Request $request, EntityManagerInterface $manager): Response
  {
    $property = new Property;
    $form = $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $manager->persist($property);
      $manager->flush();
      $this->addFlash('success', 'Bien créer avec succès');
      return $this->redirectToRoute('admin_property');
    }
    return $this->render('admin_property/new.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/property/edit/{id}", name="admin.property.edit", methods="GET|POST")
   */

  public function edit(Property $property, Request $request, EntityManagerInterface $manager): Response
  {

    $form = $this->createForm(PropertyType::class, $property);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $manager->flush();
      $this->addFlash('success', 'Bien modifié avec succès');
      return $this->redirectToRoute('admin_property');
    }
    return $this->render('admin_property/edit.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }
  /**
   * @Route("/admin/property/delete/{id}", name="admin.property.delete", methods="DELETE")
   */

  public function delete(Property $property, EntityManagerInterface $manager)
  {
    $manager->remove($property);
    $manager->flush();
    $this->addFlash('success', 'Bien supprimé avec succès');
    return $this->redirectToRoute('admin_property');
  }
}
