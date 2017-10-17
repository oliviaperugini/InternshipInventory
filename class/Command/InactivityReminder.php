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

    public static function cliExec(){
        require_once(PHPWS_SOURCE_DIR . 'inc/intern_defines.php');

        \PHPWS_Core::initModClass('users', 'Users.php');
        \PHPWS_Core::initModClass('users', 'Current_User.php');

        $userId = \PHPWS_DB::getOne("SELECT id FROM users WHERE username = 'jb67803'");

        $user = new \PHPWS_User($userId);

        // Auth for production
        $user->auth_script = 'shibbolethnocreate.php';
        $user->auth_name = 'shibbolethnocreate';

        // Auth for local testing. Uncomment for local testing.
        //$user->auth_script = 'local.php';
        //$user->auth_name = 'local';

        //$user->login();
        $user->setLogged(true);

        \Current_User::loadAuthorization($user);
        //\Current_User::init($user->id);
        $_SESSION['User'] = $user;

        $obj = new InactivityReminder();
        $obj->execute();
    }

}
