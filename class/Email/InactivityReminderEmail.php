<?php

namespace Intern\Email;
use \Intern\Internship;
use \Intern\InternSettings;
use \Intern\Term;

class InactivityReminderEmail extends Email{

    private $internship;
    private $time; // Time interval that was set in command class.
    private $user;

    public function __construct(InternSettings $emailSettings, Internship $internship, $time, $user)
    {
        parent::__construct($emailSettings);

        $this->internship = $internship;
        $this->time = $time;
        $this->user = $user;

    }

    protected function getTemplateFileName() {
        return 'email/InactivityReminderEmail.tpl';
    }

    protected function buildMessage()
    {
        $this->to = explode(','. $this->emailSettings->getInactivityReminderEmail());

        $faculty = $this->internship->getFaculty();
        $this->tpl['DAYS'] = $this->time;

        $this->tpl['NAME'] = $this->internship->getFullName();
        $this->tpl['STUDENT_USER'] = $this->internship->email;
        $this->tpl['BANNER'] = $this->internship->banner;
        $this->tpl['STUDENT_PHONE'] = $this->internship->phone;
        $this->tpl['TERM'] = Term::rawToRead($this->internship->getTerm());

        $startDate = $this->internship->getStartDate(true);
        if(isset($startDate)){
            $this->tpl['START_DATE'] = $startDate;
        }else{
            $this->tpl['START_DATE'] = '(not provided)';
        }

        $endDate = $this->internship->getEndDate(true);
        if(isset($endDate)){
            $this->tpl['END_DATE'] = $endDate;
        }else{
            $this->tpl['END_DATE'] = '(not provided)';
        }

        if($faculty instanceof Faculty){
            $faculty = $this->internship->getFaculty();
            $this->tpl['FACULTY'] = $faculty->getFullName() . ' (' . $faculty->getId() . ')';
        }else{
            $this->tpl['FACULTY'] = '(not provided)';
        }

        $department = $this->internship->getDepartment();
        $this->tpl['DEPT'] = $department->getName();


        $this->subject = 'Internship Inactivity Reminder';

        $this->to[] = $this->user . $this->emailSettings->getEmailDomain();
    }

}
