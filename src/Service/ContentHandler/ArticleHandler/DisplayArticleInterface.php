<?php


namespace App\Service\ContentHandler\ArticleHandler;


use App\Collection\ArticleCollection;

interface DisplayArticleInterface
{
    public function showArticles(): ?ArticleCollection;

}