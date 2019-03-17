<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 07/03/2019
 * Time: 01:24
 */

namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    public function checkPreAuth(UserInterface $user)
    {

        if (!$user instanceof User) {
            return;
        }

        if ($user->getBanned()) {

            throw new CustomUserMessageAuthenticationException(
                'Vous êtes banni du site, désolé'
            );
        }

    }


    public function checkPostAuth(UserInterface $user)
    {


    }


}