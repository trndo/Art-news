<?php


namespace App\Service\FileManager;


use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager implements FileManagerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    private $uploadDir;

    public function __construct($uploadDir, LoggerInterface $logger)
    {
        $this->uploadDir = $uploadDir;
        $this->logger = $logger;
    }

    public function uploadFile(?UploadedFile $uploadedFile, string $folder, $hash = null): ?string
    {
        if (!$uploadedFile instanceof UploadedFile)
            return null;
        try{
            if ($hash) {
                $fileName = $this->uploadDir.$folder.$hash;
                if (file_exists($fileName))
                    unlink($fileName);
            }
            $newFileName = $this->hashFile($uploadedFile->getClientOriginalName()).'.'.$uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($this->uploadDir.$folder,$newFileName);
        } catch (FileException $exception) {
            $this->logger->error('Error of file uploader cause of: '.$exception->getMessage());
            return null;
        }
        return $newFileName;
    }

    public function getUploadDir(): ?string
    {
        return $this->uploadDir;
    }

    private function hashFile(string $filename): string
    {
        return \md5(\uniqid($filename));
    }

    public function deleteFile(string $folder, string $fileName): void
    {
        unlink($this->getUploadDir().$folder.$fileName);
    }
}