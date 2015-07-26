<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 26/07/2015
 * Time: 14:14
 */

namespace My\DataSourceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use My\DataSourceBundle\Entity\Resume;
use My\DataSourceBundle\Utilities\Helper;


class LoadResumeData implements FixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //load profile
        $users = $manager->getRepository('MyUserBundle:User')
            ->findAll();
        //building Activity
        //$u = new User();

        foreach ($users as $u) {
            $resume = new Resume();
            $resume->setUserId($u->getId());
            $resume->setEmail($u->getEmail());
            $resume->setFirstName(Helper::randomFirstName());
            $resume->setLastName(Helper::randomLastName());
            $resume->setStatus(1);
            $manager->persist($resume);
        }

        $manager->flush();


    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

}