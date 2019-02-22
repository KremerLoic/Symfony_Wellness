<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Entity\Surfer;
use App\Form\RegisterProviderFormType;
use App\Form\RegisterSurferFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileController extends AbstractController
{


    /**
     * @Route("/profile", name="profile")
     */
    public function update(UserInterface $user, Request $request)
    {


        $form = $this->createFormCase($user);
        $form->remove('password');
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('profile');

        }

        if ($user instanceof Provider) {
            return $this->render('profile/providerProfile.html.twig', [
                'form' => $form->createView(),
            ]);
        } else if ($user instanceof Surfer) {
            return $this->render('profile/surferProfile.html.twig', [
                "form" => $form->createView(),
            ]);
        }

    }


    public function createFormCase($userType)
    {
        if ($userType instanceof Surfer) {
            $form = $this->createForm(RegisterSurferFormType::class, $userType);
        } else if ($userType instanceof Provider) {
            $form = $this->createForm(RegisterProviderFormType::class, $userType);
        }
        return $form;
    }

}
