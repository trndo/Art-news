<?php


namespace App\Service\ContentHandler\ResumeHandler;

use App\Collection\ResumeCollection;

interface DisplayResumeInterface
{
    public function showSlides(): ?ResumeCollection;
}