<?php
class Repartition
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($data)
    {
        if (!empty($data) && is_array($data)) {
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));

            $sql = "INSERT INTO repartition ($columns) VALUES ($placeholders)";
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

    public function update($Numdist, $newDataArray)
    {
        $setClauses = [];
        $bindValues = [];
        $types = '';
    
        foreach ($newDataArray as $field => $value) {
            $setClauses[] = "`$field` = ?";
            $bindValues[] = $value;
            $types .= $this->getBindType($value);
        }
    
        $bindValues[] = $Numdist;
    
        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE `repartition` SET $setClause WHERE `Numdist` = ?";
    
        $stmt = $this->db->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param($types . 's', ...$bindValues);
            $stmt->execute();
            $stmt->close();
            return true;
        } else {
            echo "Error in SQL statement: " . $this->db->error;
            return false;
        }
    }

    public function delete($numdist)
    {
        $sql = "DELETE FROM repartition WHERE Numdist = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $numdist);
        $stmt->execute();
        $stmt->close();
    }

    public function getRepartition($numdist)
    {
        

        $sql = "SELECT * FROM repartition WHERE Numdist = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $numdist);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public function getAllRepartitions()
    {
        $sql = "SELECT * FROM repartition";
        $result = $this->db->query($sql);
        $Repartitions = [];
        while ($row = $result->fetch_assoc()) {
            $Repartitions[] = $row;
        }
        return $Repartitions;
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
        $sql = "SELECT * FROM `repartition` WHERE `$critere` = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $val);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $stmt->close();
                return $result;
            }
        }
        return false;
    }
}

?>