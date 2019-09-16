<?php


namespace App\Service\ContentHandler\ArticleHandler;


use App\Collection\ArticleCollection;
use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Model\ContentModel;
use App\Repository\ArticleRepository;
use App\Repository\ArticleTranslationRepository;
use App\Service\FileManager\FileManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleHandler implements DisplayArticleInterface, ArticleHandlerInterface, ArticleTranslationInterface
{
    private const UPLOADS_IMAGES_DIR = 'images/';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ArticleRepository
     */
    private $articleRepository;
    /**
     * @var FileManagerInterface
     */
    private $fileManager;
    /**
     * @var ArticleTranslationRepository
     */
    private $articleTranslationRepository;

    /**
     * ArticleHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param ArticleRepository $articleRepository
     * @param FileManagerInterface $fileManager
     * @param ArticleTranslationRepository $articleTranslationRepository
     */
    public function __construct(EntityManagerInterface $entityManager, ArticleRepository $articleRepository, FileManagerInterface $fileManager, ArticleTranslationRepository $articleTranslationRepository)
    {
        $this->entityManager = $entityManager;
        $this->articleRepository = $articleRepository;
        $this->fileManager = $fileManager;
        $this->articleTranslationRepository = $articleTranslationRepository;
    }

    public function createArticle(ContentModel $model): void
    {
        $article = new Article();
        $articleTranslation = new ArticleTranslation();

        $articleTranslation->setTitle($model->getTitle())
            ->setBody($model->getBody())
            ->setDescription($this->processBody($model->getBody(),70))
            ->setLocale($model->getLocale());

        $this->uploadPhoto($article, $model);

        $article->addArticleTranslation($articleTranslation);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

    }

    public function deleteArticle(Article $article): void
    {
        if ($article) {
            $this->fileManager->deleteFile(self::UPLOADS_IMAGES_DIR, $article->getPhoto());
            $this->entityManager->remove($article);
            $this->entityManager->flush();
        }
    }

    public function deleteTranslation(ArticleTranslation $articleTranslation): void
    {
        $this->entityManager->remove($articleTranslation);
        $this->entityManager->flush();
    }

    public function updateArticleTranslation(ContentModel $model, ArticleTranslation $articleTranslation): void
    {
        $articleTranslation->setBody($model->getBody())
            ->setTitle($model->getTitle())
            ->setDescription($this->processBody($model->getBody(),70));
        $article = $articleTranslation->getArticle();

        $this->uploadPhoto($article, $model, $article->getPhoto());

        $this->entityManager->flush();
    }

    public function updatePhoto(Article $article, ?UploadedFile $file): void
    {
        $this->updateArticlePhoto($article, $file);

        $this->entityManager->flush();
    }

    public function showArticles(): ?ArticleCollection
    {
        return new ArticleCollection($this->articleRepository->getAllArticles());
    }

    public function createArticleTranslation(Article $article, ContentModel $model): void
    {
        $articleTranslation = new ArticleTranslation();

        $articleTranslation->setTitle($model->getTitle())
            ->setBody($model->getBody())
            ->setDescription($this->processBody($model->getBody(),70))
            ->setLocale($model->getLocale())
            ->setArticle($article);

        $this->entityManager->persist($articleTranslation);
        $this->entityManager->flush();

    }

    public function updateTranslation(ArticleTranslation $articleTranslation, ContentModel $model): void
    {
        $articleTranslation->setTitle($model->getTitle())
            ->setBody($model->getBody())
            ->setDescription($this->processBody($model->getBody(),70));

        $this->entityManager->flush();

    }

    public function getTranslationBy(?int $id): ?ArticleTranslation
    {
        return $this->articleTranslationRepository->find($id);
    }


    private function processBody(string $text,int $length): string
    {
        return strip_tags(substr($text,0,$length));
    }

    private function updateArticlePhoto(Article $article, ?UploadedFile $file, ?string $photo = null)
    {
        if ($file) {
            $photo = $this->fileManager->uploadFile($file,self::UPLOADS_IMAGES_DIR, $photo);
            $article->setPhoto($photo);
        }
    }

    private function uploadPhoto(Article $article, ContentModel $model, ?string $photo = null): void
    {
        if ($model->getPhoto() instanceof UploadedFile) {
            $photo = $this->fileManager->uploadFile($model->getPhoto(), self::UPLOADS_IMAGES_DIR, $photo);
            $article->setPhoto($photo);
        }
    }

    public function showArticleBy(?string $slug): ?Article
    {
        return $this->articleRepository->getArticleBySlug($slug);
    }


}