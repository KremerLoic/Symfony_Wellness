<?php

namespace App\Controller;

use App\Entity\Images;
use App\Form\ImageFormType;
use App\Services\FileUploader;
use League\Flysystem\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

class ImageController extends AbstractController
{

    private $target;

    /**
     * ContactController constructor.
     *
     * @param $target
     */
/*
    public function __construct($target)
    {
        $this->target = $target;
    }


    /**
     * @Route("/image", name="image")
     */
/*
    public function new(UserInterface $user, Request $request, FileUploader $fileUploader)
    {
        $image = new Images();
        $form = $this->createForm(ImageFormType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           /* $file = $form->get('image')->getData();*/


            /** @var /*UploadedFile $file */

            /*$file = $image->getImage();*/
            /*
            $file = $form->get('image')->getData();
            $fileName = $fileUploader->upload($file);

            $image->setImage($fileName);
            $image->setOrdre(1);
            $image->setLogoProvider($this->getUser());
            */
/*

            $image->setLogoProvider($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();


            return $this->redirect($this->generateUrl('index'));
        }

        return $this->render('image/image.html.twig', [
            'form' => $form->createView(),
        ]);
    }

*/

}

