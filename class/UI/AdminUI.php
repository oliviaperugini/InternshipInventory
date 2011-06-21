<?php
/**
 * Class for handling UI for Admin editing and creation
 * @author Micah Carter <mcarter at tux dot appstate dot edu>
**/

class AdminUI implements UI {

    // Show a list of admins and a form to add a new one.
    public static function display() {
        // permissions...
        if(!Current_User::isDeity()) {
            NQ::simple('intern', INTERN_ERROR, 'You cannot edit administrators.');
            return false;
        }

        // set up some stuff for the page template
        $tpl                     = array();
        $tpl['PAGE_TITLE']       = 'Edit Administrators';
        $tpl['HOME_LINK']        = PHPWS_Text::moduleLink('Back to menu','intern');

        // create the list of admins
        $adminList = Admin::getAdminPager();

        // get the list of departments
        PHPWS_Core::initModClass('intern','Department.php');
        $depts = Department::getDepartmentsAssoc();

        // make the form for adding a new admin
        $form = new PHPWS_Form('add_admin');
        $form->addSelect('department_id', $depts);
        $form->setLabel('department_id','Department');
        $form->addText('username');
        $form->setLabel('username','Username');
        $form->addSubmit('submit','Create Admin');
        $form->setAction('index.php?module=intern&action=edit_admins');
        $form->addHidden('add', 1);

        // TODO: Add Javascript autocomplete for usernames.

        $tpl['PAGER'] = $adminList;

        $form->mergeTemplate($tpl);

        return PHPWS_Template::process($form->getTemplate(), 'intern','edit_admin.tpl');

    }
}