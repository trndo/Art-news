<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Collection\ResumeCollection;
use App\Entity\Resume;
use App\Entity\ResumeTranslation;
use App\Model\ContentModel;
use App\Repository\ResumeRepository;
use App\Repository\ResumeTranslationRepository;
use App\Service\FileManager\FileManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ResumeHandler implements ResumeHandlerInterface, DisplayResumeInterface, ResumeTranslationInterface
{
    private const UPLOADS_IMAGES_DIR = 'resume/';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ResumeRepository
     */
    private $resumeRepository;
    /**
     * @var FileManagerInterface
     */
    private $fileManager;
    /**
     * @var ResumeTranslationRepository
     */
    private $resumeTranslationRepository;

    public function __construct(EntityManagerInterface $entityManager, ResumeRepository $resumeRepository, FileManagerInterface $fileManager, ResumeTranslationRepository $resumeTranslationRepository)
    {
        $this->entityManager = $entityManager;
        $this->resumeRepository = $resumeRepository;
        $this->fileManager = $fileManager;
        $this->resumeTranslationRepository = $resumeTranslationRepository;
    }

    public function createResumeSlide(ContentModel $model): void
    {
        $resume = new Resume();
        $resumeTranslation = new ResumeTranslation();

        $resumeTranslation->setTitle($model->getTitle())
            ->setBody($model->getBody())
            ->setLocale($model->getLocale());

        $resume->addResumeTranslation($resumeTranslation);

        $this->uploadPhoto($resume, $model);

        $this->entityManager->persist($resume);
        $this->entityManager->flush();
    }

    public function updateResumeSlide(ContentModel $model, ResumeTranslation $resumeTranslation): void
    {
        $resumeTranslation->setBody($model->getBody())
            ->setTitle($model->getTitle());
        $resume = $resumeTranslation->getResume();

        $this->uploadPhoto($resume, $model, $resume->getPhoto());

        $this->entityManager->flush();
    }

    public function updateResumePhoto(Resume $resume, ?UploadedFile $file): void
    {
        $this->updatePhoto($resume, $file);

        $this->entityManager->flush();
    }

    public function deleteResumeSlide(Resume $resume): void
    {
        if ($resume) {
            $this->fileManager->deleteFile(self::UPLOADS_IMAGES_DIR, $resume->getPhoto());
            $this->entityManager->remove($resume);
            $this->entityManager->flush();
        }
    }

    public function deleteTranslation(ResumeTranslation $resumeTranslation): void
    {
        $this->entityManager->remove($resumeTranslation);
        $this->entityManager->flush();

    }

    public function showSlides(): ?ResumeCollection
    {
        return new ResumeCollection($this->resumeRepository->getAllSlides());
    }

    public function createResumeTranslation(Resume $resume, ContentModel $model): void
    {
        $articleTranslation = new ResumeTranslation();

        $articleTranslation->setTitle($model->getTitle())
            ->setBody($model->getBody())
            ->setLocale($model->getLocale())
            ->setResume($resume);

        $this->entityManager->persist($articleTranslation);
        $this->entityManager->flush();

    }

    public function getTranslationBy(?int $id): ?ResumeTranslation
    {
        return $this->resumeTranslationRepository->find($id);
    }


    private function uploadPhoto(Resume $resume, ContentModel $model, ?string $photo = null): void
    {
        if ($model->getPhoto() instanceof UploadedFile) {
            $photo = $this->fileManager->uploadFile($model->getPhoto(), self::UPLOADS_IMAGES_DIR, $photo);
            $resume->setPhoto($photo);
        }
    }

    private function updatePhoto(Resume $resume, ?UploadedFile $file, ?string $photo = null)
    {
        if ($file) {
            $photo = $this->fileManager->uploadFile($file,self::UPLOADS_IMAGES_DIR, $photo);
            $resume->setPhoto($photo);
        }
    }

    /**
     * @param ResumeTranslation $articleTranslation
     * @param ContentModel $model
     */
    public function updateTranslation(ResumeTranslation $articleTranslation, ContentModel $model): void
    {
        $articleTranslation->setTitle($model->getTitle())
            ->setBody($model->getBody());

        $this->entityManager->flush();
    }
}