<?php

namespace Intern;

use \phpws2\Database;

class InternshipFactory {

    /**
     * Generates an Internship object by attempting to load the internship from the database with the given id.
     *
     * @param int $id
     * @return Internship
     * @throws InvalidArgumentException
     * @throws Exception
     * @throws InternshipNotFoundException
     */
    public static function getInternshipById($id)
    {
        if(is_null($id) || !isset($id)){
            throw new \InvalidArgumentException('Internship ID is required.');
        }

        if($id <= 0){
            throw new \InvalidArgumentException('Internship ID must be greater than zero.');
        }

        $db = Database::newDB();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare("SELECT * FROM intern_internship WHERE id = :id");
        $stmt->execute(array('id' => $id));
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Intern\InternshipRestored');

        return $stmt->fetch();
    }

    /**
     * Returns an array of Internship objects which are in the early stages of pending approval.
     * Mainly used to send reminders to internships that aren't getting approved in a timely manner.
     * As long as the Sig Auth person has approved it (i.e. it's pending Dean approval), then we don't
     * need to send a reminder. This does include internships in the 'Registration Issue' status.
     *
     * @param int $term
     * @return Array<Internship> Array of all pending Internship objects in the given term
     * @throws InvalidArgumentException
     */
    public static function getPendingInternshipsByTerm($term)
    {
        $db = Database::newDB();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare("SELECT *
                               FROM intern_internship
                               WHERE state IN ('NewState', 'SigAuthReadyState', 'RegistrationIssueState')
                                    AND term = :term");
        $stmt->execute(array('term'  => $term));
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Intern\InternshipRestored');

        return $stmt->fetchAll();
    }

    /**
     * Returns an array of Internship objects that are filtered by their
     * last modified time. Filter out internships that have already received
     * inactivity reminder emails. Filter out internships by state.
     *
     * @param int $time last modified time
     * @return Array<Internship> Array of all Internship objects that need
     *         inactivity reminder email
     */
    public static function getInternshipsByLastModTime($time)
    {
        $dc = Database::newDB();
        $pdo = $db->getPDO();

        //statement to send to database
        $stmt = $pdo->prepare("SELECT *
                               FROM intern_internship
                               WHERE state IN ('NewState', 'SigAuthReadyState')
                                    AND last_mod_time ");
        //$stmt->execute(array('last_mod_time' =>));
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Intern\InternshipRestored');

        return $stmt->fetchAll();

    }
}
