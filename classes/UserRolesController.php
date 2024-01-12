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

        public function get_role_id_by_user_id(int $user_id)
        {
            $sql = "SELECT * FROM user_roles WHERE user_id = :id";
            $args = ['id' => $user_id];
            return $this->db->runSQL($sql, $args)->fetch();
        }

        public function delete_user(int $id){
            $sql = "DELETE FROM user_roles WHERE user_id = :user_id";
            $args = ['user_id' => $id];
            return $this->db->runSQL($sql, $args);
        }

        public function register_user(array $user_role){
            try {
                $sql = "INSERT INTO user_roles(user_id, role_id) 
                        VALUES (:user_id, :role_id)"; 

                $this->db->runSQL($sql, $user_role);
                return true;

            } catch (PDOException $e) {
                // Handle specific error codes (like duplicate entry)
                if ($e->getCode() == 23000) { // Possible duplicate entry
                    return false;
                }
                throw $e;
            }
        }
    }
?>