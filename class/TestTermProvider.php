<?php

namespace Intern;

/**
 * TestStudentProvider - Always returns student objects with hard-coded testing data
 *
 * Usually created through the TermProviderFactory.
 *
 * @see \Intern\TermProviderFactory
 * @author Jeremy Booker
 * @package Intern
 */
class TestTermProvider extends BannerTermProvider {

    private $term;

    public function __construct($currentUserName) {
        $this->currentUserName = $currentUserName;
    }

    protected function sendRequest(Array $params)
    {
        $this->term = $params['Term'];
        return $this->getFakeResponse();
        //return $this->getFakeErrorResponse();
    }

    private function getFakeResponse()
    {
        $obj = new \stdClass();
        $responseObj = new \stdClass();

        $responseObj->term_code             = $this->term;
        $responseObj->term_desc             = Term::rawToRead(substr($this->term, 0, 5));

        switch ($this->term){
            case '201620':
                $responseObj->census_date   = '5/25/2016';
                break;
            case '201630':
                $responseObj->census_date   = '7/4/2016';
                break;
            case '201640':
                $responseObj->term_start_date   = '8/15/2016';
                $responseObj->term_end_date     = '1/5/2017';
                $responseObj->census_date   = '8/29/2016';
                break;
            case '201710':
                $responseObj->term_start_date   = '1/17/2017';
                $responseObj->term_end_date     = '5/11/2016';
                $responseObj->census_date       = '1/30/2017';

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '1';
                $partTerm->part_term_desc   = 'Full Term';
                $partTerm->part_start_date  = '1/17/2017';
                $partTerm->part_end_date    = '5/11/2017';
                $responseObj->part_term[] = $partTerm;

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '2';
                $partTerm->part_term_desc   = 'First Half of Term';
                $partTerm->part_start_date  = '3/7/2017';
                $partTerm->part_end_date    = '3/6/2017';
                $responseObj->part_term[] = $partTerm;

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '4';
                $partTerm->part_term_desc   = 'Special Term';
                $partTerm->part_start_date  = '12/13/2016';
                $partTerm->part_end_date    = '5/29/2017';
                $responseObj->part_term[] = $partTerm;
                break;
            case '201720':
                $responseObj->term_start_date   = '5/30/2017';
                $responseObj->term_end_date     = '6/30/2016';
                $responseObj->census_date       = '6/01/2017';

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '1';
                $partTerm->part_term_desc   = 'Full Term';
                $partTerm->part_start_date  = '5/30/2017';
                $partTerm->part_end_date    = '8/8/2017';
                $responseObj->part_term[] = $partTerm;

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = 'SD';
                $partTerm->part_term_desc   = 'Summer Term Special';
                $partTerm->part_start_date  = '5/4/2017';
                $partTerm->part_end_date    = '8/14/2017';
                $responseObj->part_term[] = $partTerm;

                break;
            case '201730':
                $responseObj->term_start_date   = '7/6/2017';
                $responseObj->term_end_date     = '8/8/2017';
                $responseObj->census_date       = '7/10/2017';

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = 'SE';
                $partTerm->part_term_desc   = 'Summer Term Special';
                $partTerm->part_start_date  = '7/1/2017';
                $partTerm->part_end_date    = '8/14/2017';
                $responseObj->part_term[] = $partTerm;

                break;
            case '201740':
                $responseObj->term_start_date   = '8/22/2017';
                $responseObj->term_end_date     = '12/16/2017';
                $responseObj->census_date       = '9/5/2017';

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '1';
                $partTerm->part_term_desc   = 'Full Term';
                $partTerm->part_start_date  = '8/22/2017';
                $partTerm->part_end_date    = '12/14/2017';
                $responseObj->part_term[] = $partTerm;

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '2';
                $partTerm->part_term_desc   = 'First Half of Term';
                $partTerm->part_start_date  = '10/11/2017';
                $partTerm->part_end_date    = '10/10/2017';
                $responseObj->part_term[] = $partTerm;

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = 'EGF';
                $partTerm->part_term_desc   = 'Distance Ed Graduate Flexible';
                $partTerm->part_start_date  = '8/9/2017';
                $partTerm->part_end_date    = '1/15/2018';
                $responseObj->part_term[] = $partTerm;

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '4';
                $partTerm->part_term_desc   = 'Special Term';
                $partTerm->part_start_date  = '8/9/2017';
                $partTerm->part_end_date    = '1/15/2018';
                $responseObj->part_term[] = $partTerm;

                break;
            case '201810':
                $responseObj->term_start_date   = '1/11/2018';
                $responseObj->term_end_date     = '5/6/2018';
                $responseObj->census_date       = '1/20/2018';

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '1';
                $partTerm->part_term_desc   = 'Full Term';
                $partTerm->part_start_date  = '12/22/2017';
                $partTerm->part_end_date    = '5/14/2018';
                $responseObj->part_term[] = $partTerm;

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '2';
                $partTerm->part_term_desc   = 'First Half of Term';
                $partTerm->part_start_date  = '1/11/2018';
                $partTerm->part_end_date    = '3/15/2018';
                $responseObj->part_term[] = $partTerm;

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = '4';
                $partTerm->part_term_desc   = 'Special Term';
                $partTerm->part_start_date  = '12/18/2017';
                $partTerm->part_end_date    = '5/28/2018';
                $responseObj->part_term[] = $partTerm;

                break;
            case '201820':
                $responseObj->term_start_date   = '1/16/2018';
                $responseObj->term_end_date     = '5/1/2018';
                $responseObj->census_date       = '1/28/2018';

                $partTerm = new \stdClass();
                $partTerm->part_term_code   = 'SD';
                $partTerm->part_term_desc   = 'Special Term';
                $partTerm->part_start_date  = '12/18/2017';
                $partTerm->part_end_date    = '5/28/2018';
                $responseObj->part_term[] = $partTerm;

                break;
            case '201830':
                  $responseObj->term_start_date   = '7/6/2018';
                  $responseObj->term_end_date     = '8/8/2018';
                  $responseObj->census_date       = '7/10/2018';

                  $partTerm = new \stdClass();
                  $partTerm->part_term_code   = 'SE';
                  $partTerm->part_term_desc   = 'Summer Term Special';
                  $partTerm->part_start_date  = '7/1/2018';
                  $partTerm->part_end_date    = '8/14/2018';
                  $responseObj->part_term[] = $partTerm;

                  break;
            default:
                throw new \Exception('Missing fake census date for ' . $this->term);
        }


        // This is a backup to make sure we have at least one part of term, if we haven't set one in the switch statement above
        // The dates will always be in 2016, but at least we'll have a part of term object to use
        if(sizeof($responseObj->part_term) === 0){

            $partTerm = new \stdClass();

            $semester = Term::getSemester($this->term);
            if($semester == Term::SPRING || $semester == Term::FALL){
                $partTerm->part_term_code   = '4';
            } else if($semester == Term::SUMMER1){
                $partTerm->part_term_code   = 'SD';
            } else if($semester == Term::SUMMER2){
                $partTerm->part_term_code   = 'SE';
            }

            $partTerm->part_term_desc   = 'Special Term';
            $partTerm->part_start_date  = '6/7/2016';
            $partTerm->part_end_date    = '7/14/2016';

            $responseObj->part_term[] = $partTerm;
        }

        $parentObj = new \stdClass();
        $parentObj->GetTermInfoResult = $responseObj;

        return $parentObj;
    }

    private function getFakeErrorResponse()
    {
        $resultObj = new \stdClass();
        $resultObj->error_desc = 'InvalidUserName';

        $obj = new \stdClass();
        $obj->GetTermInfoResult = $resultObj;

        return $obj;
    }
}
