<?php


namespace App\Form;

use App\Entity\Images;
use App\Entity\Provider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ImageType extends FileType
{
    private $imagePath;
    /**
     * ImageType constructor.
     *
     * @param $imagePath
     */
    public function __construct( $imagePath ) {
        $this->imagePath = $imagePath;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->addModelTransformer(new CallbackTransformer(
            function(Images $image = null){
                if($image instanceof Images){
                    try{
                        $f = new File($this->imagePath."/".$image->getImage());
                        return $f;
                    }catch(FileNotFoundException $e){
                        dump($e->getMessage());
                    }
                }return null;
            },
            function(UploadedFile $uploadedFile =null ){
                if($uploadedFile instanceof UploadedFile){
                    $image = new Images();
                    $image->setImage($uploadedFile);

                    return $image;
                }
            }
        ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'required' => false,
        ]);
    }
}