<?php

namespace AppBundle\Twig;

use Doctrine\ORM\EntityManager;
use Orbitale\Bundle\CmsBundle\Entity\Category;
use Orbitale\Bundle\CmsBundle\Entity\Page;

class AppExtension extends \Twig_Extension
{

    /**
     * @var Page[]
     */
    protected $pages;

    /**
     * @var Category[]
     */
    protected $categories;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_pages', array($this, 'getPages')),
            new \Twig_SimpleFunction('get_categories', array($this, 'getCategories')),
        );
    }

    /**
     * @param bool $root
     *
     * @return array|\Orbitale\Bundle\CmsBundle\Entity\Page[]
     */
    public function getPages($root = false)
    {
        if (null === $this->pages) {
            $this->pages = $this->em->createQueryBuilder()
                ->select('p')
                ->from('OrbitaleCmsBundle:Page', 'p')
                ->where('p.parent is null')
                ->andWhere('p.enabled = :enabled')->setParameter('enabled', true)
                ->leftJoin('p.children', 'children', 'children.parent = p AND children.enabled = :enabled')->addSelect('children')
                ->getQuery()->getResult()
            ;
        }

        if (false === $root) {
            return $this->pages;
        }

        $roots = array();
        foreach ($this->pages as $page) {
            if (!$page->getParent()) {
                $roots[] = $page;
            }
        }
        return array_filter($this->pages, function(Page $page) { return !$page->getParent(); });
    }

    /**
     * @return array|Category[]
     */
    public function getCategories()
    {
        if (null === $this->categories) {
            $this->categories = $this->em->getRepository('OrbitaleCmsBundle:Category')->findAll() ?: array();
        }
        return $this->categories;
    }


}