<?php


namespace App\Service\FileManager;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager implements FileManagerInterface
{

    public function uploadFile(?UploadedFile $uploadedFile, string $folder, $hash = null): ?string
    {
        // TODO: Implement uploadFile() method.
    }

    public function getUploadDir(): ?string
    {
        // TODO: Implement getUploadDir() method.
    }
}