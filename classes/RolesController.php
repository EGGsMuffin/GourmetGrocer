<?php
    // Class for handling Roles-related operations
    class RolesController {

        // Protected property to store the database controller instance
        protected $db;

        // Constructor to initialize the RolesController with a DatabaseController instance
        public function __construct(DatabaseController $db)
        {
            // Assign the provided DatabaseController instance to the db property
            $this->db = $db;
        }


        public function get_role_by_role_id(int $id)
        {
            $sql = "SELECT * FROM roles WHERE id = :id";
            $args = ['id' => $id];
            return $this->db->runSQL($sql, $args)->fetch();
        }

        public function get_all_roles()
        {

            $sql = "SELECT * FROM roles";
            
            return $this->db->runSQL($sql)->fetchAll();
        }

    }
?>