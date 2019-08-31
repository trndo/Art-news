<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Collection\ResumeCollection;

interface DisplayResumeArticle
{
    public function showSlides(): ?ResumeCollection;
}