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
use App\Form\ContactType;
use App\Repository\ProviderRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;
use Symfony\Flex\Response;

class ProviderController extends AbstractController
{

    /**
     * @Route("/providers", name="all_providers")
     */
    public function index(PaginatorInterface $paginator, Request $request){



        $repository = $this->getDoctrine()->getRepository(Provider::class);

        $providers = $paginator->paginate(
            $repository->findAllProviders(),
            $request->query->getInt('page',1),
            6
        );


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
     * @param $id
     * @Route("/provider/{id}", name="provider_show")
     */
    public function OneProvider($id , Request $request, \Swift_Mailer $mailer){
        $repository = $this->getDoctrine()->getRepository(Provider::class);
        $provider = $repository->find($id);


        return $this->render('provider/show.html.twig',[
            'provider' => $provider,
        ]);

    }





}