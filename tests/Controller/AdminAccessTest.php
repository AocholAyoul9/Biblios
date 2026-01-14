<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminAccessTest extends WebTestCase
{
    public function testAdminPageRedirectsForAnonymous(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/book');

        $this->assertResponseRedirects('/login');
    }

    public function testAdminAccessForAdminUser(): void
    {
        $client = static::createClient();
        $entityManager = self::getContainer()->get('doctrine')->getManager();

        $user = new User();
        $user->setEmail('admin' . uniqid() . '@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Admin');
        $user->setLastname('User');

        // Hash the password
        $passwordHasher = self::getContainer()->get(UserPasswordHasherInterface::class);
        $user->setPassword($passwordHasher->hashPassword($user, 'admin123'));

        $entityManager->persist($user);
        $entityManager->flush();

        $client->loginUser($user);
        $client->request('GET', '/admin/book');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('h1'); 
    }
}
