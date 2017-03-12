<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Poll
 *
 * @ORM\Table(name="poll")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PollRepository")
 */
class Poll
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(groups={"step1"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=true)
     * @Assert\NotBlank(groups={"step3"})
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     * @Assert\NotBlank(groups={"step2"})
     * @Assert\Type("\DateTime", groups={"step2"})
     */
    private $birthDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_interested_programming", type="boolean", nullable=true)
     */
    private $isInterestedProgramming;

    /**
     * @var ArrayCollection
     */
    private $skills;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\NotBlank()
     * @Assert\File(mimeTypes={ "application/jpeg" })
     */
    private $image;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Poll
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Poll
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return Poll
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set isInterestedProgramming
     *
     * @param bool $isInterestedProgramming
     *
     * @return Poll
     */
    public function setIsInterestedProgramming(bool $isInterestedProgramming)
    {
        $this->isInterestedProgramming = $isInterestedProgramming;

        return $this;
    }

    /**
     * Get isInterestedProgramming
     *
     * @return bool
     */
    public function getIsInterestedProgramming()
    {
        return $this->isInterestedProgramming;
    }

    /**
     * @param array $skills
     *
     * @return Poll
     */
    public function setSkills(array $skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->skills;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
