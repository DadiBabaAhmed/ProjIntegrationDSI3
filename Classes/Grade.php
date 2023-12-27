<?php
class Grades {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Create a new grade
    public function addGrade($grade, $chargeTP, $chargeC, $chargeTD, $gradeArab, $chargeCI, $chargeTotal) {
        $sql = "INSERT INTO grades (Grade, ChargeTP, ChargeC, ChargeTD, GradeArab, ChargeCI, ChargeTotal) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sddddsd", $grade, $chargeTP, $chargeC, $chargeTD, $gradeArab, $chargeCI, $chargeTotal);
        $stmt->execute();
        return true;
    }

    // Retrieve all grades
    public function getGrades() {
        $sql = "SELECT * FROM grades";
        $result = $this->db->query($sql);
        return $result;
    }

    // Retrieve a specific grade by ID
    public function getGradeById($gradeId) {
        $sql = "SELECT * FROM grades WHERE Grade = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $gradeId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update an existing grade
    public function updateGrade($grade, $newData) {
        $setClauses = [];
            $bindValues = [];
            $types = '';
        
            foreach ($newData as $field => $value) {
                $setClauses[] = "`$field` = ?";
                $bindValues[] = $value;
                $types .= $this->getBindType($value);
            }
        
            $bindValues[] = $grade;
        
            $setClause = implode(', ', $setClauses);
            $sql = "UPDATE `grades` SET $setClause WHERE `Grade` = ?";
        
            $stmt = $this->db->prepare($sql);
        
            if ($stmt) {
                $stmt->bind_param($types . 's', ...$bindValues);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Error in SQL statement: " . $this->db->error;
            }
    }

    // Delete a grade
    public function deleteGrade($gradeId) {
        $sql = "DELETE FROM grades WHERE Grade = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $gradeId);
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

    public function search($critere, $val)
    {
        $sql = "SELECT * FROM `grades` WHERE `$critere` = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $val);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return false;
    }
}
?>
