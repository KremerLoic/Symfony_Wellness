<?php

namespace App\Controller;

use App\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function Index()
    {
        $repository = $this->getDoctrine()->getRepository(Services::class);
        $services = $repository->findAll();

        return $this->render('service/login.html.twig', [
            'services' => $services
        ]);



    }

    public function AllServices()
    {
        $repository = $this->getDoctrine()->getRepository(Services::class);
        $services = $repository->findAll();

        return $this->render('service/services.html.twig', [
            'services' => $services
        ]);
    }


    public function searchServicesList()
    {
        $repository = $this->getDoctrine()->getRepository(Services::class);
        $services = $repository->findAll();

        return $this->render('service/searchServicesList.html.twig', [
            'services' => $services
        ]);
    }


    /**
     * @param $id
     * @Route("/service/{id}", name="service_show")
     */
    public function OneService($id)
    {

        $repository = $this->getDoctrine()->getRepository(Services::class);
        $service = $repository->find($id);


        return $this->render('service/show.html.twig', [
            'service' => $service,

        ]);
    }






}
