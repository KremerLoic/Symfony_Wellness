<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Provider;

use App\Entity\Surfer;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class CommentController extends AbstractController
{
    /**
     * @Route("/provider/{id}", name="comment")
     */
    public function index( $id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Provider::class);
        $provider = $repository->find($id);
        $comments = $this->getDoctrine()->getRepository(Comments::class)->find($id);
        $hasAccess = $this->isGranted('ROLE_SURFER');

        if ($hasAccess) {

            $comment = new Comments();

            $form = $this->createForm(CommentType::class, $comment);
            $form->handleRequest($request);
            $comment->setEncode(new \DateTime());
            $comment->setProvider($provider);
            $comment->setSurfer($this->getUser());



            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();

                return $this->redirectToRoute('comment', array('id' => $id));
            }

            return $this->render('provider/show.html.twig', [
                'provider' => $provider,
                'comments' => $comments,
                'form' => $form->createView()
            ]);
        } else {
            return $this->render('provider/show.html.twig', [
                'provider' => $provider,
                'comments' => $comments,
            ]);

        }

    }
}