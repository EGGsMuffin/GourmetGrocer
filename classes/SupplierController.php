<?php
    // Class for handling Supplier-related operations
    class SuppliersController {

        // Protected property to store the database controller instance
        protected $db;

        // Constructor to initialize the SuppliersController with a DatabaseController instance
        public function __construct(DatabaseController $db)
        {
            // Assign the provided DatabaseController instance to the db property
            $this->db = $db;
        }

        //Gets all rows of data from the suppliers table
        public function get_all_suppliers()
        {
            //Selects all data
            $sql = "SELECT * FROM suppliers";
            
            //Runs the sql command through the database
            return $this->db->runSQL($sql)->fetchAll();
        }

        //Gets all data from the suppliers table based on id
        public function get_supplier_by_supplier_id(int $id){
            //Selects all data where the id matches
            $sql = "SELECT * FROM suppliers WHERE supplier_id = :supplier_id";
            $args = ['supplier_id' => $id];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args)->fetch();
        }

        //Gets all data from the suppliers table based on name
        public function get_supplier_by_company_name(string $companyName){
            //Selects all data where the name matches
            $sql = "SELECT * FROM suppliers WHERE company = :company";
            $args = ['company' => $companyName];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args)->fetchAll();
        }

        //Creates a new row in the suppliers table
        public function register_supplier(array $supplier){
            try {
                //Creates a new row of data
                $sql = "INSERT INTO suppliers(company, contactName, contactEmail, contactPhone, postalCode, country) 
                        VALUES (:company, :contactName, :contactEmail, :contactPhone, :postalCode, :country)";

                //Runs the sql command through the database
                $this->db->runSQL($sql, $supplier);
                return true;

            } catch (PDOException $e) {
                // Handle specific error codes (like duplicate entry)
                if ($e->getCode() == 23000) { // Possible duplicate entry
                    return false;
                }
                throw $e;
            }
        }

        //Deletes a row in the suppliers table
        public function delete_supplier(int $id){
            //Deletes a row of data
            $sql = "DELETE FROM suppliers WHERE supplier_id = :supplier_id";
            $args = ['supplier_id' => $id];

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $args);
        }

        //Updates a row of data in the suppliers table
        public function update_supplier(array $supplier){
            //Updates a row of data
            $sql = "UPDATE suppliers SET company = :company, contactName = :contactName, contactEmail = :contactEmail,
            contactPhone = :contactPhone, postalCode = :postalCode, country = :country WHERE supplier_id = :supplier_id";

            //Runs the sql command through the database
            return $this->db->runSQL($sql, $supplier);
        }
    }
?>