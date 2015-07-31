<?php

namespace My\DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 */
class Notification
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $pusher_id;

    /**
     * @var integer
     */
    private $receiver_id;

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
     * Set pusher_id
     *
     * @param integer $pusherId
     * @return Notification
     */
    public function setPusherId($pusherId)
    {
        $this->pusher_id = $pusherId;

        return $this;
    }

    /**
     * Get pusher_id
     *
     * @return integer 
     */
    public function getPusherId()
    {
        return $this->pusher_id;
    }

    /**
     * Set receiver_id
     *
     * @param integer $receiverId
     * @return Notification
     */
    public function setReceiverId($receiverId)
    {
        $this->receiver_id = $receiverId;

        return $this;
    }

    /**
     * Get receiver_id
     *
     * @return integer 
     */
    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Notification
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
     * @return Notification
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
     * @return Notification
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
        $this->created_at = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new \DateTime();
    }
}
