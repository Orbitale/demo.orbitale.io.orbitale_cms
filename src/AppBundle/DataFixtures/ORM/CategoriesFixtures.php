<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Orbitale\Component\DoctrineTools\AbstractFixture;

class CategoriesFixtures extends AbstractFixture
{

    public function getOrder() {
        return 1;
    }

    /**
     * Returns the class of the entity you're managing
     *
     * @return string
     */
    protected function getEntityClass()
    {
        return 'Orbitale\Bundle\CmsBundle\Entity\Category';
    }

    /**
     * Returns a list of objects to
     *
     * @return ArrayCollection|object[]
     */
    protected function getObjects()
    {
        return array(
            array('enabled' => true, 'name' => 'Default', 'description' => "This is a basic category"),
        );
    }

    protected function getReferencePrefix()
    {
        return 'category-';
    }
}
