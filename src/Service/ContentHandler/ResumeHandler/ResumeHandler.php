<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Entity\Resume;
use App\Entity\ResumeTranslation;
use App\Model\ContentModel;
use Doctrine\ORM\EntityManagerInterface;

class ResumeHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createResumeSlide(ContentModel $model): void
    {
        $resume = new Resume();
        $resumeTranslation = new ResumeTranslation();

        $resumeTranslation->setTitle($model->getTitle())
            ->setBody($model->getBody())
            ->setLocale($model->getLocale());

        $resume->setPhoto($model->getPhoto())
            ->addResumeTranslation($resumeTranslation);

        $this->entityManager->persist($resume);
        $this->entityManager->flush();
    }

    public function updateResumeSlide(ContentModel $model, ResumeTranslation $resumeTranslation): void
    {
        $resumeTranslation->setBody($model->getBody())
            ->setTitle($model->getTitle());
        $resume = $resumeTranslation->getResume();
        $resume->setPhoto($model->getPhoto());

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
}