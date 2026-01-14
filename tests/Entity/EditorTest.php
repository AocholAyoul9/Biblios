<?php

namespace App\Tests\Entity;

use App\Entity\Editor;
use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class EditorTest extends TestCase
{
    public function testEditorProperties(): void
    {
        $editor = new Editor();
        $editor->setName('TechPress');

        $this->assertEquals('TechPress', $editor->getName());
    }

    public function testEditorBooksAssociation(): void
    {
        $editor = new Editor();
        $book = new Book();
        $book->setTitle('PHP for All');

        $book->setEditor($editor);

        $this->assertSame($editor, $book->getEditor());
    }
}
