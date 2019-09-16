<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Entity\Resume;
use App\Entity\ResumeTranslation;
use App\Model\ContentModel;

interface ResumeTranslationInterface
{

    /**
     * @param Resume $article
     * @param ContentModel $model
     */
    public function createResumeTranslation(Resume $article, ContentModel $model): void;

    /**
     * @param int|null $id
     * @return ResumeTranslation|null
     */
    public function getTranslationBy(?int $id): ?ResumeTranslation;

    /**
     * @param ResumeTranslation $articleTranslation
     * @param ContentModel $model
     */
    public function updateTranslation(ResumeTranslation $articleTranslation, ContentModel $model): void ;
}