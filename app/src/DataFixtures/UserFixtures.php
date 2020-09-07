<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("user OK with date not null");
        $user->setSampleNullableDate(new \DateTime());
        $user->setEmail("OK@test.fr");
        $user->setPassword("password");
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setUsername("user NOK with null date");
        $user->setEmail("NOK@test.fr");
        $user->setPassword("password");
        $manager->persist($user);
        $manager->flush();
    }
}