<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Collection\ResumeCollection;
use App\Entity\Resume;
use App\Entity\ResumeTranslation;
use App\Model\ContentModel;
use App\Repository\ResumeRepository;
use App\Service\FileManager\FileManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ResumeHandler implements ResumeHandlerInterface, DisplayResumeArticle
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

    public function __construct(EntityManagerInterface $entityManager, ResumeRepository $resumeRepository, FileManagerInterface $fileManager)
    {
        $this->entityManager = $entityManager;
        $this->resumeRepository = $resumeRepository;
        $this->fileManager = $fileManager;
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

    public function deleteResumeSlide(Resume $resume): void
    {
        if ($resume) {
            $this->entityManager->remove($resume);
            $this->entityManager->flush();
        }
    }

    public function deleteTranslation(ResumeTranslation $resumeTranslation): void
    {
        $resume = $resumeTranslation->getResume();

        if ($resume->getResumeTranslations()->count() == 2) {
            $this->entityManager->remove($resumeTranslation);
            $this->entityManager->flush();
        }

        $this->deleteResumeSlide($resume);
    }

    public function showSlides(): ?ResumeCollection
    {
        return new ResumeCollection($this->resumeRepository->getAllSlides());
    }

    private function uploadPhoto(Resume $resume, ContentModel $model, ?string $photo = null): void
    {
        if ($model->getPhoto() instanceof UploadedFile) {
            $photo = $this->fileManager->uploadFile($model->getPhoto(), self::UPLOADS_IMAGES_DIR, $photo);
            $resume->setPhoto($photo);
        }
    }
}