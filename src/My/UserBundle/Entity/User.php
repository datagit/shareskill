<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 26/07/2015
 * Time: 13:33
 */

namespace My\UserBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}