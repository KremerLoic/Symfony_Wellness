<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Entity\Surfer;
use App\Entity\TempUser;
use App\Entity\Services;
use App\Entity\User;
use App\Form\RegisterFormType;
use App\Form\RegisterProviderFormType;
use App\Form\RegisterSurferFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TempUserController extends AbstractController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, \Swift_Mailer $mailer)
    {

        $tempUser = new TempUser();
        $form = $this->createForm(RegisterFormType::class, $tempUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            $tempUser->setToken($token);
            $type = $tempUser->getType();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tempUser);
            $em->flush();

            $message = (new \Swift_Message('You got Mail!'))
                ->setFrom('loickremer882@gmail.com')
                ->setTo($tempUser->getEmail())
                ->setBody(
                    "Lien de confirmation de votre compte :  http://localhost:8000/register/$type/$token"
                );

            $mailer->send($message);

        }

        return $this->render('security/register.html.twig', array(
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/register/{type}/{token}", name="register_confirm")
     */
    public function registerConfirm(Request $request, $token, $type)
    {

        $repository = $this->getDoctrine()->getRepository(TempUser::class);
        $tempUser = $repository->findOneBy(['token' => $token]);

        if ($tempUser) {
            if ($type === 'Provider') {
                $provider = new Provider();
                $form = $this->createForm(RegisterProviderFormType::class, $provider);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $provider->setBanned(false);
                    $provider->setConfirmed(true);
                    $provider->setRegistrationDate(new \DateTime());
                    $provider->setFailedTry(0);
                    $provider->setPassword($this->encoder->encodePassword($provider, $provider->getPassword()));
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($tempUser);
                    $em->persist($provider);
                    $em->flush();

                    return $this->redirectToRoute('app_login');
                }



            } else if ($type === 'Surfer') {

                $surfer = new Surfer();
                $form = $this->createForm(RegisterSurferFormType::class, $surfer);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $surfer->setBanned(false);
                    $surfer->setConfirmed(true);
                    $surfer->setRegistrationDate(new \DateTime());
                    $surfer->setFailedTry(0);
                    $surfer->setPassword($this->encoder->encodePassword($surfer, $surfer->getPassword()));

                    $em = $this->getDoctrine()->getManager();
                    $em->remove($tempUser);
                    $em->persist($surfer);
                    $em->flush();

                    return $this->redirectToRoute('app_login');

                }


            }
        } else {
            echo('Cet utilisateur n\'existe pas ou est déjà enregistré.');
            return $this->redirectToRoute('index');

        }

        return $this->render('security/register.html.twig', array(
            "form" => $form->createView()
        ));


    }
}
