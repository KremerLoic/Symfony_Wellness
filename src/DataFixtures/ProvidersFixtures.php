<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 22/10/2018
 * Time: 19:04
 */

namespace App\DataFixtures;


use App\Entity\Images;
use App\Entity\Locality;
use App\Entity\Provider;
use App\Entity\Services;
use App\Entity\ZipCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class ProvidersFixtures extends Fixture
{

    public $nbServices = 10;
    public $nbProviders = 20;
    public $nbLocality = 10;
    public $nbZipCode = 10;
    public $nbImages = 30;

    public $tabProvider = array();

    public function load(ObjectManager $manager)
    {


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


        for ($i = 0; $i < $this->nbLocality; $i++) {

            $locality = new Locality();
            $locality->setLocality('Locality_' . $i);

            $tabLocality[] = $locality;

            $manager->persist($locality);

        }


        for ($i = 0; $i < $this->nbZipCode; $i++) {

            $zipCode = new ZipCode();
            $zipCode->setZipcode(462 . $i);

            $tabZipCode[] = $zipCode;

            $manager->persist($zipCode);

        }


        for ($i = 0; $i < $this->nbProviders; $i++) {
            $provider = new Provider();
            $provider->setNumber('3');
            $provider->setStreet('street');
            $provider->setBanned(false);
            $provider->setEmail('loickremer882@gmail.com_' . $i);
            $provider->setConfirmed(true);
            $provider->setRegistrationDate(new \DateTime());
            $provider->setPassword('passwordSecure');
            $provider->setFailedTry('0');
            $provider->setEmailProvider('emailProvider_' . $i);
            $provider->setName('ProviderName_' . $i);
            $provider->setTelNumber('ProviderTelNumber_' . $i);
            $provider->setTvaNumber('ProviderTvaNumber_' . $i);
            $provider->setWebsite('ProviderWebsite_' . $i);
            $provider->setZipCode($tabZipCode[array_rand($tabZipCode)]);
            $provider->setLocality($tabLocality[array_rand($tabLocality)]);
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


        for ($i = 0; $i < $this->nbImages; $i++) {

            $image = new Images();
            $image->setImage('https://www.stevensegallery.com/200/150');
            $image->setOrdre(1);
            $image->setPhotoProvider($tabProvider[array_rand($tabProvider)]);
            $image->setLogoProvider($tabProvider[array_rand($tabProvider)]);

            $manager->persist($image);

        }


        $manager->flush();

    }


}