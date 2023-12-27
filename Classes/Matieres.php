<?php
class Matieres {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Create a new matiere
    public function addMatiere($codeMatiere, $nomMatiere, $coefMatiere, $departement, $semestre, $options, $nbHeureCI, $nbHeureTP, $typeLabo, $bonus, $categories, $sousCategories, $dateDeb, $dateFin) {
        $sql = "INSERT INTO matieres (Code_Matiere, Nom_Matiere, Coef_Matiere, Departement, Semestre, Options, Nb_Heure_CI, Nb_Heure_TP, TypeLabo, Bonus, Categories, SousCategories, DateDeb, DateFin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssdssssdsdssss", $codeMatiere, $nomMatiere, $coefMatiere, $departement, $semestre, $options, $nbHeureCI, $nbHeureTP, $typeLabo, $bonus, $categories, $sousCategories, $dateDeb, $dateFin);
        $stmt->execute();
        return true;
    }

    // Retrieve all matieres
    public function getMatieres() {
        $sql = "SELECT * FROM matieres";
        $result = $this->db->query($sql);
        return $result;
    }

    // Retrieve a specific matiere by Code_Matiere
    public function getMatiereByCode($codeMatiere) {
        $sql = "SELECT * FROM matieres WHERE Code_Matiere = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $codeMatiere);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update an existing matiere
    public function updateMatiere($codeMatiere, $newData) {
        $setClauses = [];
        $bindValues = [];
        $types = '';
    
        foreach ($newData as $field => $value) {
            $setClauses[] = "`$field` = ?";
            $bindValues[] = $value;
            $types .= $this->getBindType($value);
        }
    
        $bindValues[] = $codeMatiere;
    
        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE `matieres` SET $setClause WHERE `Code_Matiere` = ?";
    
        $stmt = $this->db->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param($types . 's', ...$bindValues);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error in SQL statement: " . $this->db->error;
        }
    }

    // Delete a matiere
    public function deleteMatiere($codeMatiere) {
        $sql = "DELETE FROM matieres WHERE Code_Matiere = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $codeMatiere);
        $stmt->execute();
        return true;
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

    public function search($critere, $val) {
        $sql = "SELECT * FROM matieres WHERE $critere LIKE '%$val%'";
        $result = $this->db->query($sql);
        return $result;
    }
}
?>
