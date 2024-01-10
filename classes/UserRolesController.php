<?php
    // Class for handling UserRoles-related operations
    class UserRolesController {

        // Protected property to store the database controller instance
        protected $db;

        // Constructor to initialize the UserRolesController with a DatabaseController instance
        public function __construct(DatabaseController $db)
        {
            // Assign the provided DatabaseController instance to the db property
            $this->db = $db;
        }


        public function get_userRole_by_user_id(int $user_id)
        {
            $sql = "SELECT * FROM user_roles WHERE user_id = :id";
            $args = ['id' => $user_id];
            return $this->db->runSQL($sql, $args)->fetch();
        }

    }
?>