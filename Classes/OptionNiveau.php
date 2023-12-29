<?php
class OptionNiveau {
private $db;

    // Constructor
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getOptionsNames() {
        $sql = "SELECT `Option`, `Niveau` FROM optionniveau";
        $stmt = $this->db->query($sql);
        $opnames = [];
        while ($row = $stmt->fetch_assoc()) {
            $opnames[] = $row;
        }
        return $opnames;
        
    }

}



?>