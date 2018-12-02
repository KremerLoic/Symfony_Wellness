<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 06/11/2018
 * Time: 20:57
 */

namespace App\Cloudinary;


class Cloudinary
{

    public static function connect()
    {

        \Cloudinary::config(array(
            "cloud_name" => getenv('CLOUDINARY_CLOUD'),
            "api_key" => getenv('CLOUDINARY_API_KEY'),
            "api_secret" => getenv('CLOUDINARY_SECRET_KEY')
        ));

    }

}