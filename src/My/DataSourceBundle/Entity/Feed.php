<?php

namespace My\DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feed
 */
class Feed
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
     * @var string
     */
    private $content_json;

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
     * @return Feed
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
     * @return Feed
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
     * Set content_json
     *
     * @param string $contentJson
     * @return Feed
     */
    public function setContentJson($contentJson)
    {
        $this->content_json = $contentJson;

        return $this;
    }

    /**
     * Get content_json
     *
     * @return string 
     */
    public function getContentJson()
    {
        return $this->content_json;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Feed
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
     * @return Feed
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
     * @return Feed
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
