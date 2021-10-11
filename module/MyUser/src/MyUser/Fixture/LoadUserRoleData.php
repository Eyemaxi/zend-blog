<?php

namespace MyUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use MyUser\Entity\Role;

class LoadUserRoleData extends AbstractFixture
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $guestRole = new Role();
        $guestRole->setRoleId('guest');

        $userRole = new Role();
        $userRole->setRoleId('user');
        $userRole->setParent($guestRole);

        $adminRole = new Role();
        $adminRole->setRoleId('admin');
        $adminRole->setParent($userRole);

        $manager->persist($guestRole);
        $manager->persist($userRole);
        $manager->persist($adminRole);
        $manager->flush();
    }
}