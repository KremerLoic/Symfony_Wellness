<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 22/10/2018
 * Time: 19:04
 */

namespace App\DataFixtures;


use App\Entity\User;
use App\Entity\Comments;
use App\Entity\Images;
use App\Entity\Locality;
use App\Entity\Provider;
use App\Entity\Services;
use App\Entity\Stage;
use App\Entity\Surfer;
use App\Entity\ZipCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ProvidersFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public $nbServices = 10;
    public $nbProviders = 20;
    public $nbLocality = 10;
    public $nbZipCode = 10;
    public $nbImages = 30;
    public $nbStages = 5;
    public $nbComments = 30;
    public $nbSurfers = 20;


    public $tabProvider = array();

    public function load(ObjectManager $manager)
    {


        // Load Services fixtures



        for ($i = 0; $i < $this->nbServices; $i++) {
            $services = new Services();

            $services->setDescription("desc_$i");
            $services->setHighlight("Highlight_$i");
            $services->setIsValid(true);
            $services->setLogin("Login_$i");
            $services->setName("Name_$i");
            $this->addReference("Service_$i", $services);

            $manager->persist($services);


        }

        // Load Localities fixtures

        for ($i = 0; $i < $this->nbLocality; $i++) {

            $locality = new Locality();
            $locality->setLocality('Locality_' . $i);

            $tabLocality[] = $locality;

            $manager->persist($locality);

        }


        // Load ZipCode  fixtures

        for ($i = 0; $i < $this->nbZipCode; $i++) {

            $zipCode = new ZipCode();
            $zipCode->setZipcode(462 . $i);

            $tabZipCode[] = $zipCode;

            $manager->persist($zipCode);

        }
        for($i = 0 ; $i < 1; $i++){
            $admin = new User();
            $admin->setNumber('O');
            $admin->setStreet('Rue de la rue');
            $admin->setBanned(false);
            $admin->setEmail('admin@wellness.com');
            $admin->setConfirmed(true);
            $admin->setRegistrationDate(new \DateTime());
            $admin->setPassword($this->encoder->encodePassword($admin, 'admin'));
            $admin->setFailedTry('0');
            $admin->setZipCode($tabZipCode[array_rand($tabZipCode)]);
            $admin->setLocality($tabLocality[array_rand($tabLocality)]);
            $admin->setRoles(['ROLE_ADMIN']);


            $manager->persist($admin);

        }



        // Load Providers Fixtures
        for ($i = 0; $i < $this->nbProviders; $i++) {
            $provider = new Provider();
            $provider->setNumber('3');
            $provider->setStreet('street');
            $provider->setBanned(false);
            $provider->setEmail('loickremer'.$i.'@gmail.com');
            $provider->setConfirmed(true);
            $provider->setRegistrationDate(new \DateTime());
            $provider->setPassword('passwordSecure');
            $provider->setFailedTry('0');
            $provider->setEmailProvider('emailProvider'.$i.'@gmail.com');
            $provider->setName('ProviderName_' . $i);
            $provider->setTelNumber('045678765' . $i);
            $provider->setTvaNumber('09876543218765' . $i);
            $provider->setWebsite('ProviderWebsite_' . $i);
            $provider->setZipCode($tabZipCode[array_rand($tabZipCode)]);
            $provider->setLocality($tabLocality[array_rand($tabLocality)]);

            // Load services_provider reference fixtures
            $tabServices = array();
            for ($j = 0; $j < $this->nbServices; $j++) {
                do {
                    $temp = $this->getReference("Service_$j");
                } while (in_array($temp, $tabServices));
                $tabServices[] = $temp;
            }
            foreach ($tabServices as $service) {
                $provider->addService($service);
            }
            $tabProvider[] = $provider;
            $manager->persist($provider);
        }





        // Load Images fixtures
        for ($i = 0; $i < $this->nbImages; $i++) {

            $image = new Images();
            $image->setImage('https://www.stevensegallery.com/200/150');
            $image->setPhotoProvider($tabProvider[array_rand($tabProvider)]);


            $manager->persist($image);
        }



        // load Stages fixtures
        for ($i = 0; $i < $this->nbStages; $i++){

            $stage = new Stage();
            $stage->setDateStart(new \DateTime());
            $stage->setDateFrom(new \DateTime());
            $stage->setDateEnd(new \DateTime('+5 year'));
            $stage->setDateTo(new \DateTime('+5year') );
            $stage->setDescription('Stage_Description_' . $i);
            $stage->setMoreInfos('Stage_Info_' . $i);
            $stage->setName('Stage_Name_'. $i);
            $stage->setPrice($i . '€');
            $stage->setOrganiser($tabProvider[array_rand($tabProvider)]);

            $manager->persist($stage);

        }

        // load surfers fixtures
        for ($i=0 ; $i < $this->nbSurfers; $i++ ){

            $surfer = new Surfer();
            $surfer->setFirstname('SurferFirstName_'.$i);
            $surfer->setName('SurferName_'.$i);
            $surfer->setNewsletter(true);
            $surfer->setNumber('7'.$i);
            $surfer->setStreet('Rue_'.$i);
            $surfer->setBanned(false);
            $surfer->setEmail('surferEmail'.$i.'@hotmail.com');
            $surfer->setConfirmed(true);
            $surfer->setRegistrationDate(new \DateTime());
            $surfer->setPassword('Password_'.$i);
            $surfer->setFailedTry('0');
            $surfer->setZipCode($tabZipCode[array_rand($tabZipCode)]);
            $surfer->setLocality($tabLocality[array_rand($tabLocality)]);

            $tabSurfer[] = $surfer;

            $manager->persist($surfer);

        }


        // load comments fixtures
        for($i = 0 ; $i < $this->nbComments; $i++){
            $comments = new Comments();
            $comments->setContent('ContenuDuCommentaire_'.$i);
            $comments->setNote(rand(1,5));
            $comments->setEncode(new \DateTime());
            $comments->setTitle('Titre du commentaire_'.$i);
            $comments->setProvider($tabProvider[array_rand($tabProvider)]);
            $comments->setSurfer($tabSurfer[array_rand($tabSurfer)]);

            $manager->persist($comments);
        }




        $manager->flush();


    }


}