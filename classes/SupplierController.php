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

        public function get_all_suppliers()
        {

            $sql = "SELECT * FROM suppliers";
            
            return $this->db->runSQL($sql)->fetchAll();
        }
    }
?>