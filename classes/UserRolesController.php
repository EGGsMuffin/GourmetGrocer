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

        //Gets all row of data in the userRoles table based on id
        public function get_role_id_by_user_id(int $user_id)
        {
            //Select all row of data where id matches
            $sql = "SELECT * FROM user_roles WHERE user_id = :id";
            $args = ['id' => $user_id];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args)->fetch();
        }

        //Deletes a row of data in the userRoles table
        public function delete_user_role(int $id){
            //Deletes a row of data
            $sql = "DELETE FROM user_roles WHERE user_id = :user_id";
            $args = ['user_id' => $id];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args);
        }

        //Creates a row of data in the userRoles table
        public function register_user_role(array $user_role){
            try {
                //Inserts a row of data
                $sql = "INSERT INTO user_roles(user_id, role_id) 
                        VALUES (:user_id, :role_id)"; 

                //Runs the sql command through the database
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