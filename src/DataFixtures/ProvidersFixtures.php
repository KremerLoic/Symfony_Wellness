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
use App\Entity\ZipCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class ProvidersFixtures extends Fixture
{

    public $tabProvider = array();

    public function load(ObjectManager $manager)
    {


        for ($i = 0; $i < 10; $i++) {

            $locality = new Locality();
            $locality-> setLocality('Locality_'.$i);

            $tabLocality[] = $locality;

            $manager->persist($locality);

        }


        for ($i = 0; $i < 10; $i++) {

            $zipCode = new ZipCode();
            $zipCode-> setZipcode(462 .$i);

            $tabZipCode[] = $zipCode;

            $manager->persist($zipCode);

        }


        for ($i = 0; $i < 20; $i++) {
            $provider = new Provider();
            $provider->setNumber('3');
            $provider->setStreet('street' );
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



            $tabProvider[] = $provider;

            $manager->persist($provider);
        }


        for ($i = 0; $i < 10; $i++) {

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