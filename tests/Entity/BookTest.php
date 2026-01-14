<?php

namespace App\Tests\Entity;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Editor;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testBookProperties(): void
    {
        $book = new Book();
        $book->setTitle('Symfony for Beginners');

        $this->assertEquals('Symfony for Beginners', $book->getTitle());
        $this->assertNull($book->getId());
    }

    public function testBookAuthorAssociation(): void
    {
        $book = new Book();
        $author = new Author();
        $author->setName('Shawil'); 

        $book->addAuthor($author); 
        
        $this->assertTrue($book->getAuthors()->contains($author));
    }

    public function testBookEditorAssociation(): void
    {
        $book = new Book();
        $editor = new Editor();
        $editor->setName('TechPress');

        $book->setEditor($editor);

        $this->assertSame($editor, $book->getEditor());
    }
}
