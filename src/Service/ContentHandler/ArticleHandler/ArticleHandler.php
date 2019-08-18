<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Model\ContentModel;
use Doctrine\ORM\EntityManagerInterface;

class ArticleHandler implements ArticleHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ArticleHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
}