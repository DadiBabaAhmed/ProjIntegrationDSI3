<?php
class Semaine {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function add($data)
    {
        if (!empty($data) && is_array($data) && count($data) > 0) {
            // Create placeholders for columns and values to be inserted
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));

            // Prepare the SQL statement
            $sql = "INSERT INTO semaine ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);

            if ($stmt) {
                // Bind values to the prepared statement
                $bindTypes = ''; // String to hold binding types
                $bindValues = array_values($data); // Values to bind

                // Determine and bind the types for the values
                foreach ($bindValues as $value) {
                    if (is_int($value)) {
                        $bindTypes .= 'i'; // Integer type
                    } elseif (is_float($value)) {
                        $bindTypes .= 'd'; // Double type
                    } elseif (is_string($value)) {
                        $bindTypes .= 's'; // String type
                    } else {
                        $bindTypes .= 'b'; // Blob type
                    }
                }

                // Bind parameters using the types and values
                $stmt->bind_param($bindTypes, ...$bindValues);

                // Execute the statement
                if ($stmt->execute()) {
                    $stmt->close();
                    return true; // Successfully inserted
                } else {
                    return false; // Failed to execute
                }
            } else {
                return false; // Failed to prepare statement
            }
        } else {
            return false; // Invalid data or empty array
        }
    }

    public function update($idSem, $newDataArray)
    {
        $setClauses = [];
        $bindValues = [];
        $types = '';

        foreach ($newDataArray as $field => $value) {
            $setClauses[] = "`$field` = ?";
            $bindValues[] = $value;
            $types .= $this->getBindType($value);
        }

        $bindValues[] = $idSem;

        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE `semaine` SET $setClause WHERE `idSem` = ?";

        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param($types . 'i', ...$bindValues); // Assuming NumSem is an integer
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error in SQL statement: " . $this->db->error;
        }
    }

    public function delete($idSem)
    {
        $sql = "DELETE FROM `semaine` WHERE `idSem` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idSem);
        $stmt->execute();
        $stmt->close();
    }

    public function getSemaine($idSem)
    {
        $sql = "SELECT * FROM `semaine` WHERE `idSem` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idSem);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public function getAllSemaines()
    {
        $sql = "SELECT * FROM `semaine`";
        $result = $this->db->query($sql);
        $semaines = [];
        while ($row = $result->fetch_assoc()) {
            $semaines[] = $row;
        }
        return $semaines;
    }

    private function getBindType($value)
    {
        if (is_int($value)) {
            return "i";
        } elseif (is_double($value) || is_float($value)) {
            return "d";
        } else {
            return "s";
        }
    }

    public function search($critere,$value)
    {
        $sql = "SELECT * FROM `semaine` WHERE `$critere` LIKE '%$value%'";
        $result = $this->db->query($sql);
        $semaines = [];
        while ($row = $result->fetch_assoc()) {
            $semaines[] = $row;
        }
        return $semaines;
    }

}
?>