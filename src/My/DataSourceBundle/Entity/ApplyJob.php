<?php

namespace My\DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ApplyJob
 */
class ApplyJob
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $job_id;

    /**
     * @var integer
     */
    private $user_id;

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
     * Set job_id
     *
     * @param integer $jobId
     * @return ApplyJob
     */
    public function setJobId($jobId)
    {
        $this->job_id = $jobId;

        return $this;
    }

    /**
     * Get job_id
     *
     * @return integer 
     */
    public function getJobId()
    {
        return $this->job_id;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return ApplyJob
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return ApplyJob
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
     * @return ApplyJob
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
