<?php


namespace App\Service\FileManager;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileManagerInterface
{
    public function uploadFile(?UploadedFile $uploadedFile, string $folder, $hash = null): ?string ;

    public function getUploadDir(): ?string ;
}