<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{



    /**
     * @Route("/contact/{id}", name="contact")
     */
    public function index($id, Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $repository = $this->getDoctrine()->getRepository(Provider::class);
        $provider = $repository->find($id);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            var_dump($data);


            $message = (new \Swift_Message($data['subject']))
                ->setFrom('loickremer882@gmail.com')
                ->setTo($provider->getEmail())
                ->setBody("Envoyé par " . $data['from']. " : " .
                    $data['message']

                );

            $mailer->send($message);
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
            'provider' => $provider
        ]);
    }
}