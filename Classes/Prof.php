<?php
class Prof
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($data)
{
    $columns = implode('`, `', array_keys($data));
    $placeholders = str_repeat('?, ', count($data));
    $placeholders = rtrim($placeholders, ', ');

    $sql = "INSERT INTO prof (`$columns`) VALUES ($placeholders)";
    $stmt = $this->db->prepare($sql);

    // Determine the types of each value and generate the corresponding binding types
    $types = '';
    foreach ($data as $value) {
        if (is_int($value)) {
            $types .= 'i'; // Integer type
        } elseif (is_float($value)) {
            $types .= 'd'; // Double type
        } else {
            $types .= 's'; // String type by default
        }
    }

    $stmt->bind_param($types, ...array_values($data));
    
    $stmt->execute();
    $stmt->close();

    
    
}

    

public function update($Matricule_Prof, $newDataArray) {
    $setClauses = [];
    $bindValues = [];
    $types = '';

    foreach ($newDataArray as $field => $value) {
        $setClauses[] = "`$field` = ?";
        $bindValues[] = $value;
        $types .= $this->getBindType($value);
    }

    $bindValues[] = $Matricule_Prof;

    $setClause = implode(', ', $setClauses);
    $sql = "UPDATE `prof` SET $setClause WHERE `Matricule` = ?";

    $stmt = $this->db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param($types . 's', ...$bindValues);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error in SQL statement: " . $this->db->error;
        die ($this->db->error);
    }
}

    public function delete($matricule)
    {
        $sql = "DELETE FROM prof WHERE `Matricule` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $matricule);
        $stmt->execute();
        $stmt->close();
    }

    public function getProf($matricule)
    {
        $sql = "SELECT * FROM prof WHERE `Matricule` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $matricule);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public function getAllProfessors()
    {
        $sql = "SELECT * FROM prof";
        $result = $this->db->query($sql);
        $professors = [];
        while ($row = $result->fetch_assoc()) {
            $professors[] = $row;
        }
        return $professors;
    }
    private function getBindType($value) {
        if (is_int($value)) {
            return "i";
        } elseif (is_double($value)) {
            return "d";
        } else {
            return "s";
        }
    }

    public function filterProfs($filterValues) {
        $sql = "SELECT * FROM prof WHERE 1=1"; // 1=1 for always true condition to start the query
        
        $bindTypes = "";
        $bindValues = [];
    
        if (!empty($filterValues)) {
            foreach ($filterValues as $key => $value) {
                if ($value !== '') { // Add a check to ensure value is not empty
                    // Modify the query for each filter attribute
                    switch ($key) {
                        case 'Matricule':
                        case 'CIN':
                        case 'Diplôme':
                            $sql .= " AND $key = ?";
                            $bindTypes .= "s"; // Assuming all values are strings
                            $bindValues[] = $value;
                            break;
                        // Add more cases for each filter attribute
                        // case 'Attribute_Name':
                        //     $sql .= " AND $key = ?";
                        //     $bindTypes .= "s"; // Adjust the bind type accordingly
                        //     $bindValues[] = $value;
                        //     break;
                        default:
                            // Handle unknown filter attributes or ignore them
                            break;
                    }
                }
            }
        }
    
        $stmt = $this->db->prepare($sql);
    
        if ($stmt) {
            if (!empty($bindValues)) {
                $stmt->bind_param($bindTypes, ...$bindValues);
            }
            $stmt->execute();
            return $stmt->get_result();
        } else {
            throw new Exception("Error in SQL statement: " . $this->db->error);
        }
    }
    
    
}
?>
