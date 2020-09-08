<?php
namespace App\DataFixtures;

use App\Entity\Organization;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class OrganizationFixtures
 * @package App\DataFixtures
 */
class OrganizationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $organization = new Organization();
        $organization->setName("Organization Test");

        $this->addReference('Organization_test', $organization);

        $manager->persist($organization);
        $manager->flush();
    }
}