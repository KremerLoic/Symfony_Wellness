<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Provider;
use App\Entity\Surfer;
use App\Entity\TempUser;
use App\Entity\Services;
use App\Entity\User;
use App\Form\RegisterFormType;
use App\Form\RegisterProviderFormType;
use App\Form\RegisterSurferFormType;
use App\Services\Contact;
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
    public function register(Request $request, Contact $register)
    {
        $tempUser = new TempUser();
        $form = $this->createForm(RegisterFormType::class, $tempUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            $tempUser->setToken($token);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tempUser);
            $em->flush();
            $register->registerMail($tempUser);

        return $this->render('temp_user/successRegister.html.twig');

        }

        return $this->render('security/register.html.twig', array(
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/register/{type}/{token}", name="register_confirm")
     */
    public function registerConfirm(Request $request, Contact $register, $token, $type)
    {

        $repository = $this->getDoctrine()->getRepository(TempUser::class);
        $tempUser = $repository->findOneBy(['token' => $token]);

        if ($tempUser) {
            if ($type === 'Provider') {

                $provider = $register->setRequiredFields($type);

                $form = $this->createForm(RegisterProviderFormType::class, $provider);
                $form->handleRequest($request);


                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $provider->setPassword($this->encoder->encodePassword($provider, $provider->getPassword()));

                    $em->remove($tempUser);
                    $em->persist($provider);
                    $em->flush();
                    $register->registerMail($provider);

                    return $this->redirectToRoute('app_login');

                }

            } else if ($type === 'Surfer') {
                $surfer= $register->setRequiredFields($type);

                $form = $this->createForm(RegisterSurferFormType::class, $surfer);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $surfer->setPassword($this->encoder->encodePassword($surfer, $surfer->getPassword()));
                    $em->remove($tempUser);
                    $em->persist($surfer);
                    $em->flush();
                    $register->registerMail($surfer);

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
