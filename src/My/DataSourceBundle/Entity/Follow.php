<?php

namespace My\DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Follow
 */
class Follow
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $follower_id;

    /**
     * @var integer
     */
    private $followed_id;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set follower_id
     *
     * @param integer $followerId
     * @return Follow
     */
    public function setFollowerId($followerId)
    {
        $this->follower_id = $followerId;

        return $this;
    }

    /**
     * Get follower_id
     *
     * @return integer 
     */
    public function getFollowerId()
    {
        return $this->follower_id;
    }

    /**
     * Set followed_id
     *
     * @param integer $followedId
     * @return Follow
     */
    public function setFollowedId($followedId)
    {
        $this->followed_id = $followedId;

        return $this;
    }

    /**
     * Get followed_id
     *
     * @return integer 
     */
    public function getFollowedId()
    {
        return $this->followed_id;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Follow
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Follow
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Follow
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
    }
}
