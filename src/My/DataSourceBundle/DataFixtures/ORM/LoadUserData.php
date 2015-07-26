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
use My\DataSourceBundle\Utilities\Helper;
use My\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $emails = array();
        for($i = 0; $i < 30; $i++) {
            $user = new User();
            $e = Helper::randomEmail();
            if( (! in_array($e, $emails)) ) {
                $user->setEmail($e);
                $user->setUsername($e);
                $user->setPlainPassword('123456');
                $emails[] = $e;

                $manager->persist($user);
            }
        }
        $manager->flush();


    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}