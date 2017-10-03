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
        return 'email/InactivityReminder.tpl';
    }

    protected function buildMessage()
    {
        $this->to = explode(','. $this->emailSettings->getInactivityReminderEmail());

        $this->tpl['NAME'] = $this->internship->getFullName();
        $this->tpl['BANNER'] = $this->internship->banner;
        $this->tpl['TERM'] = Term::rawToRead($this->internship->getTerm());
        $this->tpl['EMAIL'] = $this->internship->getEmailAddress() . $this->emailSettings->getEmailDomain();
    }

}
