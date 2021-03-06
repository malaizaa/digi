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
    CONST SKILL_PHP = 'php';
    CONST SKILL_CSS = 'css';
    CONST SKILL_HTML = 'html';
    CONST SKILL_JAVASCRIPT = 'javascript';
    CONST SKILL_JAVA = 'java';
    CONST SKILL_NONE = 'none';

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
     * @ORM\Column(type="smallint")
     */
    private $question;

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
     * @var array
     *
     * @ORM\Column(type="array", nullable=false)
     */
    private $skills;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\Image(maxSize = "500k", groups={"step6"})
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
     * @param int $question
     *
     * @return $this
     */
    public function setQuestion(int $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuestion()
    {
        return $this->question;
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
    public function setSkills($skills)
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

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getSkill($skill)
    {
        // if value exist
        return array_search('none', $this->skills);
    }

    /**
     * @return bool
     */
    public function isFinishedInStep4() : bool
    {
        return ($this->getQuestion() === 4 && ! $this->getIsInterestedProgramming());
    }

    /**
     * @return bool
     */
    public function isFinishedInStep5() : bool
    {
        return ($this->getQuestion() === 5 && false !== $this->getSkill(self::SKILL_NONE));
    }

    /**
     * @return bool
     */
    public function isFinished() : bool
    {
        return ($this->isFullyFinished() || $this->isFinishedInStep4() || $this->isFinishedInStep5());
    }

    /**
     * @return bool
     */
    public function isFullyFinished() : bool
    {
        return ($this->getQuestion() === 6);
    }
}
