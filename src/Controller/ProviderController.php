<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 22/10/2018
 * Time: 20:18
 */

namespace App\Controller;


use App\Entity\Locality;
use App\Entity\Provider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{


    /**
     * @Route("/providers", name="all_providers")
     */
    public function AllProviders(){
        $repository = $this->getDoctrine()->getRepository( Provider::class);
        $providers = $repository->findAll();



        return $this->render('provider/providers.html.twig',[
            'providers' => $providers

        ]);
    }

    public function SearchProvidersList()
    {
        $repository = $this->getDoctrine()->getRepository(Provider::class);
        $providers = $repository->findAll();

        return $this->render('provider/searchProvidersList.html.twig', [
            'providers' => $providers,
        ]);

    }

    /**
     * @param $name
     * @Route("/provider/search/", name="searchProviders")
     */
    public function SearchProviderByName(Request $request)
    {


        $provider = $request->request->get('searchSelectName');


            $provider = $this->getDoctrine()
                ->getRepository(Provider::class)
                ->findProviderByName($provider);







        return  $this->render('provider/searchProvider.html.twig', [
            'provider' => $provider,

        ]);

    }


    public function SearchLocalitiesList()
    {

     $repository = $this->getDoctrine()->getRepository(Locality::class);
     $localities = $repository->findAll();

     return $this->render('provider/searchLocalitiesList.html.twig', [
         'localities' => $localities
     ]);


    }



    /**
     * @param $id
     * @Route("/provider/{id}", name="provider_show")
     */
    public function OneProvider($id){
        $repository = $this->getDoctrine()->getRepository(Provider::class);
        $provider = $repository->find($id);


        return $this->render('provider/show.html.twig',[
            'provider' => $provider,

        ]);

    }





}