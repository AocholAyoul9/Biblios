<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Entity\Book;
use App\Entity\Editor;
use App\Enum\BookStatus;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class BookControllerTest extends WebTestCase
{
    public function testPublicBookList(): void
    {
        $client = static::createClient();
        $container = self::getContainer();
        $entityManager = $container->get('doctrine')->getManager();

        $user = new User();
        $user->setEmail('user' . uniqid() . '@example.com');
        $user->setFirstname('Test');
        $user->setLastname('User');
        $user->setRoles(['ROLE_USER']);

        $passwordHasher = $container->get(UserPasswordHasherInterface::class);
        $user->setPassword($passwordHasher->hashPassword($user, 'password123'));
        $entityManager->persist($user);

        $editor = new Editor();
        $editor->setName('Test Editor');
        $entityManager->persist($editor);

        $book = new Book();
        $book->setTitle('Test Book');
        $book->setIsbn('9781234567890'); 
        $book->setCover('https://example.com/cover.jpg');
        $book->setPlot('This is a test plot with at least 20 characters.');
        $book->setPageNumber(100);
        $book->setStatus(BookStatus::Available);
        $book->setEditor($editor);
        $book->setCreatedBy($user);
        $book->setEditedAt(new \DateTimeImmutable());

        $entityManager->persist($book);
        $entityManager->flush();

        $crawler = $client->request('GET', '/book');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('h5', 'Test Book');
    }
}