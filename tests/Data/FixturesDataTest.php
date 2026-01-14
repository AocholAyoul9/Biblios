<?php

namespace App\Tests\Data;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\BookRepository;
use App\Repository\AuthorRepository;
use App\Repository\EditorRepository;

class FixturesDataTest extends KernelTestCase
{
    public function testFixturesDataExist(): void
    {
        self::bootKernel();
        $container = self::getContainer();

        $bookRepo = $container->get(BookRepository::class);
        $authorRepo = $container->get(AuthorRepository::class);
        $editorRepo = $container->get(EditorRepository::class);

        $this->assertGreaterThan(0, count($bookRepo->findAll()));
        $this->assertGreaterThan(0, count($authorRepo->findAll()));
        $this->assertGreaterThan(0, count($editorRepo->findAll()));
    }
}
