<?php

namespace App\Twig;

use Orbitale\Bundle\CmsBundle\Repository\CategoryRepository;
use Orbitale\Bundle\CmsBundle\Repository\PageRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CmsExtension extends AbstractExtension
{
    public function __construct(
        private readonly PageRepository $pageRepository,
        private readonly CategoryRepository $categoryRepository,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_pages', [$this, 'getPages']),
            new TwigFunction('get_categories', [$this, 'getCategories']),
        ];
    }

    public function getPages(): array
    {
        return $this->pageRepository->findAll();
    }

    public function getCategories(): array
    {
        return $this->categoryRepository->findAll();
    }
}
