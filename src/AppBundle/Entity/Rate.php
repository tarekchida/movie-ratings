<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 */
class Rate
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $movieId;

    /**
     * @var \DateTime
     */
    private $rateDate;


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
     * Set rate
     *
     * @param float $rate
     * @return Rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Rate
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set movieId
     *
     * @param string $movieId
     * @return Rate
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get movieId
     *
     * @return string 
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * Set rateDate
     *
     * @param \DateTime $rateDate
     * @return Rate
     */
    public function setRateDate($rateDate)
    {
        $this->rateDate = $rateDate;

        return $this;
    }

    /**
     * Get rateDate
     *
     * @return \DateTime 
     */
    public function getRateDate()
    {
        return $this->rateDate;
    }
}
