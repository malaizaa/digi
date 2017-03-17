<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Poll;

class PollTest extends \PHPUnit_Framework_TestCase
{
    /**
         * @dataProvider pollProvider
     */
    public function testItKnowsWhenFinishedInStep4($question, $isInterestingPrograming, $result)
    {
        $poll = new Poll();
        $poll->setQuestion($question);
        $poll->setIsInterestedProgramming($isInterestingPrograming);

        $this->assertEquals($result, $poll->isFinishedInStep4());
    }

    public function pollProvider()
    {
        return [
            [1, true, false],
            [4, false, true],
            [4, true, false],
            [1, false, false],
        ];
    }
}
