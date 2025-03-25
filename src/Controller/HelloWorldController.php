<?php

namespace App\Controller;

use App\Entity\Visit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HelloWorldController extends AbstractController{
    #[Route('/helloworld', name: 'app_hello_world')]
    public function index(EntityManagerInterface $em): Response
    {
        //Creamos un nuevo registro de visita
        $visit = new Visit();
        $visit->setVisitedAt(new \DateTime());

        //Guardamos el registro en la base de datos
        $em->persist($visit);
        $em->flush();

        //Obtener la ultima visita de la pagina web
        $lastVisit =$em->getRepository(Visit::class)->findOneBy([],['visitedAt' => 'DESC']);

        //Enviar la ultima visita a la plantilla 
        return $this->render('hello_world/index.html.twig', [
            'lastVisit' => $lastVisit ? $lastVisit->getVisitedAt()->format('Y-m-d H:i:s') : null,
        ]);
    }
}
