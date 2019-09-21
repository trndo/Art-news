<?php


namespace App\Service\ContentHandler\ArticleHandler;


use App\Collection\ArticleCollection;
use App\Entity\Article;

interface DisplayArticleInterface
{
    public function showArticles(string $locale = null): ?ArticleCollection;

    public function showArticleBy(?string $slug): ?Article;

}