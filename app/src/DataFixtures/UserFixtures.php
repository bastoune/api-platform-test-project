<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            OrganizationFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("test@test.fr");
        $user->setPassword("password");

        $organization = $this->getReference('Organization_test');
        $user->setOrganization($organization);

        $manager->persist($user);
        $manager->flush();
    }
}