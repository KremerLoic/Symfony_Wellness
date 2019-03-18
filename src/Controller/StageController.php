<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Form\AddStageFormType;
use PhpParser\Node\Expr\New_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class StageController extends AbstractController
{


    /**
     * @Route("/stage/remove/{id}", name="stageRemove")
     *  @IsGranted("ROLE_PROVIDER")
     */
    public function removeStage(Stage $stage)
    {
        $em = $this->getDoctrine()->getManager();
        if ($stage->getOrganiser() === $this->getUser()) {
            $em->remove($stage);
            $em->flush();
        }
        return $this->redirectToRoute('stages');
    }


    /**
     * @Route("/stages", name="stages")
     *
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Stage::class);
        $stages = $repository->findAll();

        return $this->render('stage/stages.html.twig', [
            "stages" => $stages
        ]);
    }


    /**
     * @Route("/stage/add", name="stageAdd")
     * @IsGranted("ROLE_PROVIDER")
     */
    public function addStage(Request $request, UserInterface $user)
    {

        $stage = new Stage;
        $form = $this->createForm(AddStageFormType::class, $stage);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $stage->setOrganiser($user);
            $em->persist($stage);
            $em->flush();


            return $this->redirectToRoute('stages');
        }
        return $this->render('stage/addStage.html.twig',[
            'form' => $form->createView(),
            'provider' => $user,
        ]);
    }

    /**
     * @Route("/stage/update/{id}", name="stageEdit")
     *  @IsGranted("ROLE_PROVIDER")
     */
    public function updateStage( Request $request , Stage $stageOne)
    {
        $stage = new Stage();
        $stage = $stageOne;

        $form = $this->createForm(AddStageFormType::class,$stage);


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stage);
            $em->flush();

            return $this->redirectToRoute('stages');

        }


            return $this->render('stage/addStage.html.twig', [
                'form' => $form->createView(),
            ]);

    }

}
