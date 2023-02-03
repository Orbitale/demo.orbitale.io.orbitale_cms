<?php

namespace App\DataFixtures;

use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Orbitale\Component\ArrayFixture\ArrayFixture;

class PageFixtures extends ArrayFixture implements ORMFixtureInterface, DependentFixtureInterface
{
    protected function getEntityClass(): string
    {
        return Page::class;
    }

    protected function getObjects(): iterable
    {
        yield [
            'title' => 'Test page',
            'slug' => 'test-page',
            'content' => <<<CNT
                <p>This is a test page</p>
                <p>It contains some default HTML</p>
                <ul>
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                    <li>Note that the &lt;li&gt; tags here are colored blue thanks to the page's CSS option that turned it blue</li>
                </ul>
                <blockquote>&raquo;&nbsp;This is some quote</blockquote>
                <div id="cms_bundle_post_inner_content"></div>
            CNT,
            'metaDescription' => 'Meta description for test page',
            'metaTitle' => 'Meta title for test page',
            'metaKeywords' => 'Meta keywords for test page',
            'category' => $this->getReference('category-test-category'),
            'css' => 'ul li { color: darkblue; }',
            'js' => <<<'JS'
            window.addEventListener('DOMContentLoaded', () => {
                setTimeout(function() {
                    var element = document.createElement('pre');
                    element.innerHTML = '# This whole &lt;pre&gt; tag was part is added via Javascript.'+"\n"+'# Check out the source code: it\'s not there by default!';
                    document.getElementById('cms_bundle_post_inner_content').appendChild(element);
                }, 1000)
            });
            JS,
            'createdAt' => new \DateTimeImmutable(),
            'enabled' => true,
            'homepage' => true,
            'host' => null,
            'locale' => null,
            'parent' => null,
        ];
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}
