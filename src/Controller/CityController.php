<?php

namespace App\Controller;

use App\Entity\Locality;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{


    public function SearchLocalitiesList()
    {

        $repository = $this->getDoctrine()->getRepository(Locality::class);
        $localities = $repository->findAll();

        return $this->render('provider/searchLocalitiesList.html.twig', [
            'localities' => $localities
        ]);


    }


}
