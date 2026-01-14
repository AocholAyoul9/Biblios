<?php

namespace App\Tests\Entity;

use App\Entity\Author;
use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    public function testAuthorProperties(): void
    {
        $author = new Author();
        $author->setName('Aochol')
               ->setNationality('French')
               ->setDateOfBirth(new \DateTimeImmutable('1995-01-01'));

        $this->assertEquals('Aochol', $author->getName());
        $this->assertEquals('French', $author->getNationality());
        $this->assertEquals('1995-01-01', $author->getDateOfBirth()->format('Y-m-d'));
    }

    public function testAuthorBooksAssociation(): void
    {
        $author = new Author();
        $book = new Book();
        $book->setTitle('Symfony Guide');

        $author->addBook($book);

        $this->assertTrue($author->getBooks()->contains($book));
    }
}
