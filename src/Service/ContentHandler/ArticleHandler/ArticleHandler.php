<?php


namespace App\Service\ContentHandler\ArticleHandler;


use App\Collection\ArticleCollection;
use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Model\ContentModel;
use App\Repository\ArticleRepository;
use App\Service\FileManager\FileManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleHandler implements DisplayArticleInterface, ArticleHandlerInterface
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
     * ArticleHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param ArticleRepository $articleRepository
     */
    public function __construct(EntityManagerInterface $entityManager, ArticleRepository $articleRepository, FileManagerInterface $fileManager)
    {
        $this->entityManager = $entityManager;
        $this->articleRepository = $articleRepository;
        $this->fileManager = $fileManager;
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
            $this->entityManager->remove($article);
            $this->entityManager->flush();
        }
    }

    public function deleteTranslation(ArticleTranslation $articleTranslation): void
    {
        $article = $articleTranslation->getArticle();

        if ($article->$articleTranslation()->count() == 2) {
            $this->entityManager->remove($articleTranslation);
            $this->entityManager->flush();
        }

        $this->deleteArticle($article);
    }

    public function updateArticle(ContentModel $model, ArticleTranslation $articleTranslation): void
    {
        $articleTranslation->setBody($model->getBody())
            ->setTitle($model->getTitle())
            ->setDescription($this->processBody($model->getBody(),70));
        $article = $articleTranslation->getArticle();

        $this->uploadPhoto($article, $model, $article->getPhoto());

        $this->entityManager->flush();
    }

    public function showArticles(): ?ArticleCollection
    {
        return new ArticleCollection($this->articleRepository->getAllArticles());
    }

    private function processBody(string $text,int $length): string
    {
        return strip_tags(substr($text,0,$length));
    }

    private function uploadPhoto(Article $article, ContentModel $model, ?string $photo = null): void
    {
        if ($model->getPhoto() instanceof UploadedFile) {
            $photo = $this->fileManager->uploadFile($model->getPhoto(), self::UPLOADS_IMAGES_DIR, $photo);
            $article->setPhoto($photo);
        }
    }
}