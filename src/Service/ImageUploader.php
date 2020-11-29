<?php

namespace App\Service;

use App\Entity\Project;
use Symfony\Component\HttpFoundation\File\File;

class ImageUploader
{
    private $imageDirectory;
    
    public function __construct(string $imageDirectory)
    {
        $this->imageDirectory = $imageDirectory;
    }

    public function createFileName($extension)
    {
        return uniqid() . '.' . $extension;
    }

    public function upload(File $file)
    {
        $filename = $this->createFileName($file->guessExtension());

        $file->move($this->imageDirectory, $filename);

        return $filename;
    }

    public function uploadProjectImage(Project $project, ?File $image)
    {
    //     if ($image !== null) {
    //         $filename = $this->upload($image, $this->imageDirectory);
    //         $project->setImage($filename);
    //     } else {
    //         $project->setImage(null);
    //     }
    }
}