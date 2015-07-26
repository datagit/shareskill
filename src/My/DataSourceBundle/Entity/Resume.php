<?php

namespace My\DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resume
 */
class Resume
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $user_id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var \DateTime
     */
    private $bithday;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $job_title;

    /**
     * @var integer
     */
    private $salary_min;

    /**
     * @var integer
     */
    private $salary_max;

    /**
     * @var string
     */
    private $job_title_id;

    /**
     * @var string
     */
    private $cleaning_json;

    /**
     * @var string
     */
    private $skill_json;

    /**
     * @var string
     */
    private $job_history_json;

    /**
     * @var \DateTime
     */
    private $last_view;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var integer
     */
    private $view;

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
     * Set user_id
     *
     * @param integer $userId
     * @return Resume
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
     * Set email
     *
     * @param string $email
     * @return Resume
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return Resume
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Resume
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set bithday
     *
     * @param \DateTime $bithday
     * @return Resume
     */
    public function setBithday($bithday)
    {
        $this->bithday = $bithday;

        return $this;
    }

    /**
     * Get bithday
     *
     * @return \DateTime 
     */
    public function getBithday()
    {
        return $this->bithday;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Resume
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Resume
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set job_title
     *
     * @param string $jobTitle
     * @return Resume
     */
    public function setJobTitle($jobTitle)
    {
        $this->job_title = $jobTitle;

        return $this;
    }

    /**
     * Get job_title
     *
     * @return string 
     */
    public function getJobTitle()
    {
        return $this->job_title;
    }

    /**
     * Set salary_min
     *
     * @param integer $salaryMin
     * @return Resume
     */
    public function setSalaryMin($salaryMin)
    {
        $this->salary_min = $salaryMin;

        return $this;
    }

    /**
     * Get salary_min
     *
     * @return integer 
     */
    public function getSalaryMin()
    {
        return $this->salary_min;
    }

    /**
     * Set salary_max
     *
     * @param integer $salaryMax
     * @return Resume
     */
    public function setSalaryMax($salaryMax)
    {
        $this->salary_max = $salaryMax;

        return $this;
    }

    /**
     * Get salary_max
     *
     * @return integer 
     */
    public function getSalaryMax()
    {
        return $this->salary_max;
    }

    /**
     * Set job_title_id
     *
     * @param string $jobTitleId
     * @return Resume
     */
    public function setJobTitleId($jobTitleId)
    {
        $this->job_title_id = $jobTitleId;

        return $this;
    }

    /**
     * Get job_title_id
     *
     * @return string 
     */
    public function getJobTitleId()
    {
        return $this->job_title_id;
    }

    /**
     * Set cleaning_json
     *
     * @param string $cleaningJson
     * @return Resume
     */
    public function setCleaningJson($cleaningJson)
    {
        $this->cleaning_json = $cleaningJson;

        return $this;
    }

    /**
     * Get cleaning_json
     *
     * @return string 
     */
    public function getCleaningJson()
    {
        return $this->cleaning_json;
    }

    /**
     * Set skill_json
     *
     * @param string $skillJson
     * @return Resume
     */
    public function setSkillJson($skillJson)
    {
        $this->skill_json = $skillJson;

        return $this;
    }

    /**
     * Get skill_json
     *
     * @return string 
     */
    public function getSkillJson()
    {
        return $this->skill_json;
    }

    /**
     * Set job_history_json
     *
     * @param string $jobHistoryJson
     * @return Resume
     */
    public function setJobHistoryJson($jobHistoryJson)
    {
        $this->job_history_json = $jobHistoryJson;

        return $this;
    }

    /**
     * Get job_history_json
     *
     * @return string 
     */
    public function getJobHistoryJson()
    {
        return $this->job_history_json;
    }

    /**
     * Set last_view
     *
     * @param \DateTime $lastView
     * @return Resume
     */
    public function setLastView($lastView)
    {
        $this->last_view = $lastView;

        return $this;
    }

    /**
     * Get last_view
     *
     * @return \DateTime 
     */
    public function getLastView()
    {
        return $this->last_view;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Resume
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
     * Set view
     *
     * @param integer $view
     * @return Resume
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view
     *
     * @return integer 
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Resume
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
     * @return Resume
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
