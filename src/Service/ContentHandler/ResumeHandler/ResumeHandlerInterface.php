<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Entity\Resume;
use App\Entity\ResumeTranslation;
use App\Model\ContentModel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ResumeHandlerInterface
{
    /**
     * @param ContentModel $model
     */
    public function createResumeSlide(ContentModel $model): void;

    /**
     * @param ContentModel $model
     * @param ResumeTranslation $resumeTranslation
     */
    public function updateResumeSlide(ContentModel $model, ResumeTranslation $resumeTranslation): void;

    /**
     * @param Resume $resume
     */
    public function deleteResumeSlide(Resume $resume): void;

    /**
     * @param ResumeTranslation $resumeTranslation
     */
    public function deleteTranslation(ResumeTranslation $resumeTranslation): void;

    /**
     * @param Resume $resume
     * @param UploadedFile|null $file
     */
    public function updateResumePhoto(Resume $resume, ?UploadedFile $file): void;
}