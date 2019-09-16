<?php


namespace App\Service\FileManager;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileManagerInterface
{
    /**
     * @param UploadedFile|null $uploadedFile
     * @param string $folder
     * @param null $hash
     * @return string|null
     */
    public function uploadFile(?UploadedFile $uploadedFile, string $folder, $hash = null): ?string;

    /**
     * @return string|null
     */
    public function getUploadDir(): ?string;

    /**
     * @param string $folder
     * @param string $fileName
     */
    public function deleteFile(string $folder, string $fileName): void;
}