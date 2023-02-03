<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Orbitale\Component\ArrayFixture\ArrayFixture;

class CategoryFixtures extends ArrayFixture implements ORMFixtureInterface
{
    protected function getEntityClass(): string
    {
        return Category::class;
    }

    protected function getReferencePrefix(): ?string
    {
        return 'category-';
    }

    protected function getMethodNameForReference(): string
    {
        return 'getSlug';
    }

    protected function getObjects(): iterable
    {
        yield [
            'name' => 'Test category',
            'slug' => 'test-category',
            'description' => 'This is a sample category',
            'enabled' => true,
            'parent' => null,
        ];
    }
}
