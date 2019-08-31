<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Collection\ArticleCollection;
use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Model\ContentModel;
use App\Repository\ArticleRepository;
use App\Service\ContentHandler\ArticleHandler\DisplayArticleInterface;
use Doctrine\ORM\EntityManagerInterface;

class ArticleHandler implements ArticleHandlerInterface, DisplayArticleInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * ArticleHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param ArticleRepository $articleRepository
     */
    public function __construct(EntityManagerInterface $entityManager, ArticleRepository $articleRepository)
    {
        $this->entityManager = $entityManager;
        $this->articleRepository = $articleRepository;
    }

    public function createArticle(ContentModel $model): void
    {
        $article = new Article();
        $articleTranslation = new ArticleTranslation();

        $articleTranslation->setTitle($model->getTitle())
           ->setBody($model->getBody())
           ->setDescription($this->processBody($model->getBody(),70))
           ->setLocale($model->getLocale());

        $article->setPhoto($model->getPhoto())
            ->addArticleTranslation($articleTranslation);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

    }

    public function deleteArticle(Article $article): void
    {
        if ($article){
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
        $article->setPhoto($model->getPhoto());

        $this->entityManager->flush();
    }

    private function processBody(string $text,int $length): string
    {
        return strip_tags(substr($text,0,$length));
    }


    public function showArticles(): ?ArticleCollection
    {
        return new ArticleCollection($this->articleRepository->getAllArticles());
    }
}