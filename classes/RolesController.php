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

        //Gets all rows of data from the roles table based on the id
        public function get_role_by_id(int $id)
        {
            //Selects all from the roles table where the id matches
            $sql = "SELECT * FROM roles WHERE id = :id";
            $args = ['id' => $id];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args)->fetch();
        }

        //Gets all rows of data from the roles table based on the name
        public function get_role_by_name(string $name)
        {
            //Selects all from the roles table where the name matches
            $sql = "SELECT * FROM roles WHERE name = :name";
            $args = ['name' => $name];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args)->fetch();
        }

        //Gets all rows of data from the roles table
        public function get_all_roles()
        {
            //Selects all rows of data
            $sql = "SELECT * FROM roles";
            
            //Runs the sql command through the database
            return $this->db->runSQL($sql)->fetchAll();
        }

        public function update_role(array $role)
        {
            $sql = "UPDATE roles SET name = :name, modifiedOn = :modifiedOn WHERE id = :id";

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $role);
        }

        //Creates a new row in the roles table
        public function register_role(array $role)
        {
            try {
                //Inserts a new row of data
                $sql = "INSERT INTO roles(name, createdOn, modifiedOn) 
                        VALUES (:name, :createdOn, :modifiedOn)"; 

                //Runs the sql command through the database
                $this->db->runSQL($sql, $role);
                return true;

            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    return false;
                }
                throw $e;
            }
        }

        //Deletes a row in the roles table
        public function delete_role(int $id)
        {
            //Deletes a row where the id matches
            $sql = "DELETE FROM roles WHERE id = :id";
            $args = ['id' => $id];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args);
        }
    }
?>