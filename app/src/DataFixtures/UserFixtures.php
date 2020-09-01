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
        // TODO: Implement load() method.
        $user = new User();
        $user->setEmail("test@test.fr");
        $user->setPassword("password");
        $manager->persist($user);
        $manager->flush();
    }
}