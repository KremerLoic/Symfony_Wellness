<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 16/03/2019
 * Time: 13:54
 */

namespace App\EventListener;

use App\Entity\Images;
use App\Entity\Provider;
use App\Entity\User;
use App\Form\ImageFormType;
use App\Services\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class ImageUploadListener
{
    /**
     * @var FileUploader
     */
    private $uploader;

    public function __construct(FileUploader $uploader, TokenStorageInterface $tokenStorage)
    {
        $this->uploader = $uploader;
        $this->tokenStorage = $tokenStorage;


    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();


        $this->uploadFile($entity);

    }

    public function preUpdate(PreUpdateEventArgs $args)
    {;

        $entity = $args->getEntity();

        $previousImage = null;
        // si l'entité modifiée est User
        if($entity instanceof Provider){

            // on récupère les changements
            $changes = $args->getEntityChangeSet();
            // si il y a un changement à la propriété `profilePicture`
            if(array_key_exists('logo', $changes)){


                // on récupère l'"ntité existant avant le changement
                $previousImage = $changes['logo'][0];
            }
            // si la nouvelle version du User n'a plus de profilePicture
            if(is_null($entity->getLogo())){
                // on lui réinjecte l'image précédente
                $entity->setLogo($previousImage);
            }else{
                // si une nouvelle Image est uploadée
                // et qu'il en existe déjà une dans l'entité
                if(! is_null($previousImage)){
                    $this->uploader->removeFile($previousImage);
                }
            }
        }


        $this->uploadFile($entity);

    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Images) {
            return;
        }

        $file = $entity->getImage();


        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setImage($fileName);
            $entity->setOrdre(1);
            $entity->setLogoProvider($this->tokenStorage->getToken()->getUser());


        } elseif ($file instanceof File) {

            // prevents the full file path being saved on updates
            // as the path is set on the postLoad listener

            $entity->setImage($file->getFilename());
        }
    }

}