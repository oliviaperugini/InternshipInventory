<?php
namespace Intern\Command;

class InactivityReminder {

    public function __construct()
    {

    }

    public function execute()
    {
        // Set time interval you want (ex. 21 days, 14 days,..)
        $days = 21;
        $time = days_to_seconds($days);
        // call factory method with $time in param.,
        // returns list of internship objects.
        $email_list = InternshipFactory::getInternshipsByLastModTime($time);

        // Get email settings
        $emailSettings = \Intern\InternSettings::getInstance();

        foreach ($email_list as $i) {
            // loop over each internship object
             $user = $i->getLastModTimeUser();
             //$date = date('m/d/Y h:i', $i->getLastModTime());

             //pass in parameters
             $email = new \Intern\Email\InactivityReminderEmail($emailSettings, $i, $days, $user);
             $email->send();

        }
    }

    // Days must be number.
    public function days_to_seconds($days)
    {
        return 86400 * $days;
    }

}
