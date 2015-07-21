<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Orbitale\Component\DoctrineTools\AbstractFixture;

class PagesFixtures extends AbstractFixture
{

    public function getOrder() {
        return 2;
    }

    /**
     * Returns the class of the entity you're managing
     *
     * @return string
     */
    protected function getEntityClass()
    {
        return 'Orbitale\Bundle\CmsBundle\Entity\Page';
    }

    protected function getReferencePrefix()
    {
        return 'page-';
    }

    /**
     * Returns a list of objects to
     *
     * @return ArrayCollection|object[]
     */
    protected function getObjects()
    {
        $categoryTest = $this->getReference('category-Default');

        $this->fixtureObject(array('enabled' => true, 'homepage' => true, 'title' => 'Homepage', 'content' => "This page is set as homepage, but also as <code>/{_locale}/homepage</code> with a classic usage.\nGo to <a href=\"orbitale_cms/en/admin\">the admin page</a> with the admin/admin user/password pair, and check the power of OrbitaleCmsBundle combined with EasyAdmin!"));

        $home = $this->getReference('page-Homepage');

        return array(
            array('enabled' => true, 'category' => $categoryTest, 'parent' => $home, 'title' => 'Libero Posuere', 'content' => "Nunc et feugiat lectus.\nNam porta porta augue.\nNunc viverra elit ac laoreet suscipit.\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\nMauris dapibus, risus quis suscipit vulputate, eros diam egestas libero, eu vulputate eros eros eu risus.\nSed varius a risus eget aliquam.\nPhasellus id porta orci.\nIn hac habitasse platea dictumst."),
            array('enabled' => true, 'category' => $categoryTest, 'title' => 'Diam Vulputate', 'content' => "Pellentesque vitae velit ex.\nNunc et feugiat lectus.\nNulla porta lobortis ligula vel egestas.\nCurabitur aliquam euismod dolor non ornare.\nNam porta porta augue.\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\nUt suscipit posuere justo at vulputate.\nSed varius a risus eget aliquam."),
            array('enabled' => true, 'category' => $categoryTest, 'title' => 'Tempus Sit', 'content' => "Nunc viverra elit ac laoreet suscipit.\nAliquam sodales, odio id eleifend tristique, urna nisl sollicitudin urna, id varius orci quam id turpis.\nMauris dapibus, risus quis suscipit vulputate, eros diam egestas libero, eu vulputate eros eros eu risus.\nDonec vel elit dui.\nSed varius a risus eget aliquam.\nPhasellus id porta orci."),
            array('enabled' => true, 'category' => $categoryTest, 'title' => 'Mauris Suscipit', 'content' => "Morbi tempus commodo mattis.\nDonec vel elit dui.\nMauris dapibus, risus quis suscipit vulputate, eros diam egestas libero, eu vulputate eros eros eu risus.\nUt eleifend mauris et risus ultrices egestas.\nUt suscipit posuere justo at vulputate."),
            array('enabled' => true, 'title' => 'Vulputate Posuere', 'content' => "Ut suscipit posuere justo at vulputate.\nPhasellus id porta orci.\nMorbi tempus commodo mattis.\nLorem ipsum dolor sit amet, consectetur adipiscing elit."),
            array('enabled' => true, 'parent' => $home, 'title' => 'Mattis Velit', 'content' => "In hac habitasse platea dictumst.\nSed varius a risus eget aliquam.\nMorbi tempus commodo mattis.\nNunc viverra elit ac laoreet suscipit.\nNulla porta lobortis ligula vel egestas.\nPellentesque vitae velit ex.\nPhasellus id porta orci.\nUt eleifend mauris et risus ultrices egestas.\nPellentesque et sapien pulvinar, consectetur eros ac, vehicula odio."),
            array('enabled' => true, 'title' => 'Eleifend Donec', 'content' => "Ut suscipit posuere justo at vulputate.\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\nAliquam sodales, odio id eleifend tristique, urna nisl sollicitudin urna, id varius orci quam id turpis.\nCurabitur aliquam euismod dolor non ornare.\nPellentesque et sapien pulvinar, consectetur eros ac, vehicula odio."),
            array('enabled' => true, 'title' => 'Mauris Eleifend', 'content' => "Aliquam sodales, odio id eleifend tristique, urna nisl sollicitudin urna, id varius orci quam id turpis.\nCurabitur aliquam euismod dolor non ornare.\nDonec vel elit dui.\nUt eleifend mauris et risus ultrices egestas.\nUt suscipit posuere justo at vulputate."),
            array('enabled' => true, 'title' => 'Diam Platea', 'content' => "In hac habitasse platea dictumst.\nNulla porta lobortis ligula vel egestas.\nPhasellus id porta orci.\nNunc viverra elit ac laoreet suscipit.\nNunc et feugiat lectus.\nCurabitur aliquam euismod dolor non ornare.\nAliquam sodales, odio id eleifend tristique, urna nisl sollicitudin urna, id varius orci quam id turpis.\nPellentesque et sapien pulvinar, consectetur eros ac, vehicula odio.\nNam porta porta augue."),
        );
    }
}
