<?php

namespace App\DataFixtures;

use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\EditorFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create admin user
        $admin = UserFactory::new([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'roles' => ['ROLE_ADMIN'],
            'firstname' => 'Admin',
            'lastname' => 'User',
        ])->create();

        $adminUser = $admin->object();
        $hashedPassword = $this->hasher->hashPassword($adminUser, 'admin123');
        $adminUser->setPassword($hashedPassword);
        $manager->persist($adminUser);

        // Random users
        UserFactory::createMany(5);

        // Other entities
        EditorFactory::createMany(20);
        AuthorFactory::createMany(50);
        BookFactory::createMany(100);

        $manager->flush();
    }
}
