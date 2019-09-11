<?php


namespace App\Service\ContentHandler\ArticleHandler;


use App\Collection\ArticleCollection;
use App\Entity\Article;

interface DisplayArticleInterface
{
    public function showArticles(): ?ArticleCollection;

}