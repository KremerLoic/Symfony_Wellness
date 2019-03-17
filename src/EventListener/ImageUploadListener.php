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
use App\Entity\Surfer;
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
    {
        ;

        $entity = $args->getEntity();


        $this->checkUploadEntity($entity, $args);

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


        } elseif ($file instanceof File) {

            // prevents the full file path being saved on updates
            // as the path is set on the postLoad listener

            $entity->setImage($file->getFilename());
        }
    }

    public function checkUploadEntity($entity, PreUpdateEventArgs $args)
    {
        $previousImage = null;
        if ($entity instanceof Provider) {
            $arrayKey = 'logo';
        } else if ($entity instanceof Surfer) {
            $arrayKey = 'photo';
        }else{
            return;
        }

        $getter = 'get' . ucfirst($arrayKey);
        $setter = 'get' . ucfirst($arrayKey);

        // on récupère les changements
        $changes = $args->getEntityChangeSet();
        // si il y a un changement à la propriété `profilePicture`
        if (array_key_exists($arrayKey, $changes)) {


            // on récupère l'"ntité existant avant le changement
            $previousImage = $changes[$arrayKey][0];
        }
        // si la nouvelle version du User n'a plus de profilePicture
        if (is_null($entity->$getter())) {
            // on lui réinjecte l'image précédente
            $entity->$setter($previousImage);
        } else {
            // si une nouvelle Image est uploadée
            // et qu'il en existe déjà une dans l'entité
            if (!is_null($previousImage)) {
                $this->uploader->removeFile($previousImage);
            }
        }
    }
}