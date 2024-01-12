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


        public function get_role_by_id(int $id)
        {
            $sql = "SELECT * FROM roles WHERE id = :id";
            $args = ['id' => $id];
            return $this->db->runSQL($sql, $args)->fetch();
        }

        public function get_role_name_by_id(int $id)
        {
            $sql = "SELECT * FROM roles WHERE id = :id";
            $args = ['id' => $id];
            return $this->db->runSQL($sql, $args)->fetch();
        }

        public function get_role_id_by_name(string $name)
        {
            $sql = "SELECT id FROM roles WHERE name = :name";
            $args = ['name' => $name];
            return $this->db->runSQL($sql, $args)->fetch();
        }

        public function get_role_by_name(string $name)
        {
            $sql = "SELECT * FROM roles WHERE name = :name";
            $args = ['name' => $name];
            return $this->db->runSQL($sql, $args)->fetch();
        }

        public function get_all_roles()
        {

            $sql = "SELECT * FROM roles";
            
            return $this->db->runSQL($sql)->fetchAll();
        }

        public function update_role(array $role)
        {
            $sql = "UPDATE roles SET name = :name, modifiedOn = :modifiedOn WHERE id = :id";
            return $this->db->runSQL($sql, $role);
        }

        public function register_role(array $role)
        {
            try {
                $sql = "INSERT INTO roles(name, createdOn, modifiedOn) 
                        VALUES (:name, :createdOn, :modifiedOn)"; 

                $this->db->runSQL($sql, $role);
                return true;

            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    return false;
                }
                throw $e;
            }
        }

        public function delete_role(int $id)
        {
            $sql = "DELETE FROM roles WHERE id = :id";
            $args = ['id' => $id];
            return $this->db->runSQL($sql, $args);
        }
    }
?>