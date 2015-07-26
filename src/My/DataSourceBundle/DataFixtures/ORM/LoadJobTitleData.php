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
use My\DataSourceBundle\Entity\JobTitle;
use My\DataSourceBundle\Utilities\Helper;

class LoadJobTitleData implements FixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $titles = array();
        for($i = 0; $i < 30; $i++) {
            $jobTitle = new JobTitle();
            $t = Helper::randomJobTitle();
            if( (! in_array($t, $titles)) ) {
                $jobTitle->setName($t);
                $titles[] = $t;
                $manager->persist($jobTitle);
            }
        }
        $manager->flush();


    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }

}