<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 03/03/2019
 * Time: 15:06
 */

namespace App\Services;


use App\Entity\Image;
use App\Entity\Images;
use App\Entity\Provider;
use App\Entity\Surfer;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Environment;

class Contact
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;


    /**
     * @var Environment
     */
    private $renderer;



    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {

        $this->mailer = $mailer;
        $this->renderer = $renderer;

    }

    public function registerMail(UserInterface $user)
    {

        if ($user instanceof Provider) {
            $template = 'emails/confirmProvider.html.twig';
        } else if ($user instanceof Surfer) {
            $template = 'emails/confirmSurfer.html.twig';
        } else {
            $template = 'emails/confirm.html.twig';
        }

        $message = (new \Swift_Message('You got Mail!'))
            ->setFrom('loickremer882@gmail.com')
            ->setTo($user->getUsername())
            ->setBody(
                $this->renderer->render($template, array(
                    'user' => $user,

                )),
                'text/html');

        $this->mailer->send($message);
    }


    public function setRequiredFields($typeUser)
    {

        switch ($typeUser) {
            case('Provider'):
                $provider = new Provider();
                $image = new Images();



                $provider->setBanned(false);
                $provider->setConfirmed(true);
                $provider->setRegistrationDate(new \DateTime());
                $provider->setFailedTry(0);



                return $provider;

                break;
            case('Surfer'):

                $surfer = new Surfer();

                $surfer->setBanned(false);
                $surfer->setConfirmed(true);
                $surfer->setRegistrationDate(new \DateTime());
                $surfer->setFailedTry(0);

                return $surfer;

                break;


        };
    }

}

