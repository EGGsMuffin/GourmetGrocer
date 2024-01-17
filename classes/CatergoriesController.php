<?php
    // Class for handling Categories-related operations
    class CategoriesController {

        // Protected property to store the database controller instance
        protected $db;

        // Constructor to initialize the CategoriesController with a DatabaseController instance
        public function __construct(DatabaseController $db)
        {
            // Assign the provided DatabaseController instance to the db property
            $this->db = $db;
        }

        //Get all of the rows of data in the category table
        public function get_all_categories()
        {
            //Selects all of the rows
            $sql = "SELECT * FROM category";
            
            //Runs the sql command through the database
            return $this->db->runSQL($sql)->fetchAll();
        }

        //Gets a specific row of data in the category table based on the id
        public function get_category_by_category_id(int $id){
            //Selects all from the category table where the id matches
            $sql = "SELECT * FROM category WHERE CategoryID = :CategoryID";
            $args = ['CategoryID' => $id];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args)->fetch();
        }

        //Gets a specific row of data in the category table based on the name
        public function get_category_by_category_name(string $categoryName){
            //Selects all from the category table where the name matches
            $sql = "SELECT * FROM category WHERE CategoryName = :CategoryName";
            $args = ['CategoryName' => $categoryName];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args)->fetchAll();
        }

        //Creates a new row in the category table
        public function register_category(array $category){
            try {
                //Inserts a row of data into the category table
                $sql = "INSERT INTO category(CategoryName, Description) 
                        VALUES (:CategoryName, :Description)";

                //Runs the sql command through the database
                $this->db->runSQL($sql, $category);
                return true;
            } catch (PDOException $e) {
                // Handle specific error codes (like duplicate entry)
                if ($e->getCode() == 23000) { // Possible duplicate entry
                    return false;
                }
                throw $e;
            }
        }

        //Deletes a row in the category table
        public function delete_category(int $id){
            //Deletes a row of data from the category table where the id matches
            $sql = "DELETE FROM category WHERE CategoryID = :CategoryID";
            $args = ['CategoryID' => $id];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args);
        }

        //Updates a row in the category table
        public function update_category(array $category){
            //Updates a row of data from the category table where the id matches
            $sql = "UPDATE Category SET CategoryName = :CategoryName, Description = :Description WHERE CategoryID = :CategoryID";

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $category);
        }
    }
?>