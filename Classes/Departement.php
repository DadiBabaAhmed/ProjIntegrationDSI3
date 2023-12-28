<?php
class Departement
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getDepartments($CodeDep)
    {
        $sql = "SELECT * FROM departements WHERE CodeDep = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $CodeDep);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public function getAllDepartments()
    {
        $query = "SELECT * FROM departements";
        $result = $this->db->query($query);
        $departments = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departments[] = $row;
            }
        }

        return $departments;
    }
    public function getAllDepartmentsNames()
    {
        $query = "SELECT Departement, CodeDep FROM departements";
        $result = $this->db->query($query);
        $departments_names = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departments_names[] = $row;
            }
        }

        return $departments_names;
    }

    // Function to add a new department
    public function addDepartment($data)
    {
        if (!empty($data) && is_array($data)) {
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));

            $sql = "INSERT INTO departements ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);

            if ($stmt) {
                $bindTypes = str_repeat('s', count($data)); // Assume all values are strings by default
                $bindValues = array_values($data);

                foreach ($bindValues as &$value) {
                    if (is_int($value)) {
                        $bindTypes .= 'i';
                    } elseif (is_float($value)) {
                        $bindTypes .= 'd';
                    }
                }

                $stmt->bind_param($bindTypes, ...$bindValues);

                if ($stmt->execute()) {
                    $stmt->close();
                    return true;
                }
            }
        }
        return false;
    }

    // Function to update a department
    public function updateDepartment($CodeDep, $newDataArray)
    {
        $setClauses = [];
        $bindValues = [];
        $types = '';

        foreach ($newDataArray as $field => $value) {
            $setClauses[] = "`$field` = ?";
            $bindValues[] = $value;
            $types .= $this->getBindType($value);
        }

        $bindValues[] = $CodeDep;

        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE `departements` SET $setClause WHERE `CodeDep` = ?";

        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param($types . 's', ...$bindValues);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error in SQL statement: " . $this->db->error;
        }
    }

    // Function to delete a department
    public function deleteDepartment($CodeDep)
    {
        $query = "DELETE FROM departements WHERE CodeDep = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $CodeDep);
            $stmt->execute();
            $stmt->close();
            return true;
        } else {
            echo "Error in SQL statement: " . $this->db->error;
            return false;
        }
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

    public function search($search)
    {
        $query = "SELECT * FROM departements WHERE Departement LIKE '%$search%'
                                    OR Responsable LIKE '%$search%'
                                    OR MatProf LIKE '%$search%'
                                    OR DepartementARAB LIKE '%$search%'
                                    OR CodeDep LIKE '%$search%'";
        $result = $this->db->query($query);
        $departments = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departments[] = $row;
            }
        }

        return $departments;
    }
}
