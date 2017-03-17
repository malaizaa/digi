<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Poll;

class PollTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider pollProviderForStep4
     */
    public function testItKnowsWhenFinishedInStep4($question, $isInterestingPrograming, $result)
    {
        $poll = new Poll();
        $poll->setQuestion($question);
        $poll->setIsInterestedProgramming($isInterestingPrograming);


        $this->assertEquals($result, $poll->isFinishedInStep4());
    }

    /**
     * @dataProvider pollFinishedProvider
     */
    public function testItKnowsWhenFinished($question, $isInterestingPrograming, $result)
    {
        $poll = new Poll();
        $poll->setQuestion($question);
        $poll->setIsInterestedProgramming($isInterestingPrograming);

        $this->assertEquals($result, $poll->isFinished());
    }

    public function testItFullyFinishedOnlyOnQuestion6()
    {
        $poll = new Poll();
        $poll->setQuestion(2);
        $this->assertFalse($poll->isFullyFinished());
    }

    public function testItKnowsWhenFullyFinished()
    {
        $poll = new Poll();
        $poll->setQuestion(6);
        $this->assertTrue($poll->isFullyFinished());
    }

    public function testItFinishedInStep5WhenNoneSkills()
    {
        $poll = new Poll();
        $poll->setQuestion(5);
        $poll->setSkills(['none']);

        $this->assertTrue($poll->isFinishedInStep5());
    }

    public function testItNotFinishedInStep5WithOtherSkills()
    {
        $poll = new Poll();
        $poll->setQuestion(5);
        $poll->setSkills(['php', 'css']);

        $this->assertFalse($poll->isFinishedInStep5());
    }

    public function pollProviderForStep4()
    {
        return [
            [1, true, false],
            [4, false, true],
            [4, true, false],
            [1, false, false],
        ];
    }

    public function pollFinishedProvider()
    {
        return [
            [1, true, false],
            [4, false, true],
            [4, true, false],
            [1, false, false],
            [6, true, true],
        ];
    }
}
