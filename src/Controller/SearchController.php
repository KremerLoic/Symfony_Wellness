<?php

namespace App\Controller;

use App\Entity\Provider;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProviderRepository;

class SearchController extends AbstractController
{


    /**
     * @Route("/search", name="searchProviders")
     * @param $name
     */
    public function SearchProviders(PaginatorInterface $paginator , Request $request)
    {

        $searchName = $request->get('name');
        $searchLocality = $request->get('locality');
        $searchService = $request->get('service');

        $repository = $this->getDoctrine()->getRepository(Provider::class);

        $providers = $paginator->paginate(
            $repository->findByNameCpService($searchName,$searchLocality,$searchService),
            $request->query->getInt('page',1),
            6
        );


        return $this->render('provider/searchProvider.html.twig', [
            'providers' => $providers,

        ]);

    }

}
