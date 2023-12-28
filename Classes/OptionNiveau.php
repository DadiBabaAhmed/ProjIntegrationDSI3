<?php
class OptionNiveau {
private $db;

private $id;
private $option;
private $niveau;


    // Constructor
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getOption() {
        return $this->option;
    }

    public function setOption($option) {
        $this->option = $option;
    }

    public function getNiveau() {
        return $this->niveau;
    }

    public function setNiveau($niveau) {
        $this->niveau = $niveau;
    }

    public function __toString() {
        return $this->option . " " . $this->niveau;
    }

    public function getOptionName($codeOption) {
        $sql = "SELECT `option` FROM option_niveau WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $codeOption);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['option'];
        
    }

}



?>