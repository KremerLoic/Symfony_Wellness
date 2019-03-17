<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 15/03/2019
 * Time: 17:10
 */

namespace App\Services;

use App\Entity\Images;
use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FileUploader
{
    private $targetDirectory;

    private $fs;

    /**
     * FileUploader constructor.
     * @param $targetDirectory
     * @param Filesystem $fs
     */

    public function __construct($targetDirectory, Filesystem $fs)
    {
        $this->targetDirectory = $targetDirectory;
        $this->fs = $fs;
    }
    public function upload(UploadedFile $file)
    {
        $stream = fopen($file->getRealPath(), 'r+');
        if (false === $stream) throw new UploadException('impossible de copier le fichier');
        $filename = $this->getFileName($file);
        $res = $this->fs->writeStream($filename, $stream);
        if(!$res)throw new UploadException('impossible de copier le fichier');
        //$file->move($this->targetDirectory, $filename);
        // $this->fs->copy('/'.$file->getRealPath(), $filename);
        fclose($stream);
        return $filename;
    }

    public function removeFile($file){
        if($file instanceof Images){
            $this->fs->delete($file->getImage());
        }
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    protected function getFilename(UploadedFile $file){
        return sprintf("%s.%s", md5(uniqid()), $file->guessExtension());
    }


}