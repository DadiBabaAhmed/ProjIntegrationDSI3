<?php
class Jour{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($data)
    {
        if (!empty($data) && is_array($data)) {
            $columns = implode('`, `', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));
            $sql = "INSERT INTO `jours` (`$columns`) VALUES ($placeholders)";
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

    public function update($N°, $newDataArray)
    {
        $setClauses = [];
        $bindValues = [];
        $types = '';
    
        foreach ($newDataArray as $field => $value) {
            $setClauses[] = "`$field` = ?";
            $bindValues[] = $value;
            $types .= $this->getBindType($value);
        }
    
        $bindValues[] = $N°;
    
        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE `jours` SET $setClause WHERE `N°` = ?";
    
        $stmt = $this->db->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param($types . 'i', ...$bindValues);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
        }
    
        return false;
    }

    public function delete($N°)
    {
        $sql = "DELETE FROM `jours` WHERE `N°` = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $N°);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
        }
        return false;
    }

    public function getJour($N°)
    {
        $sql = "SELECT * FROM `jours` WHERE `N°` = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $N°);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_assoc();
            }
        }
        return false;
    }

    public function getJours()
    {
        $sql = "SELECT * FROM `jours`";
        $result = $this->db->query($sql);
        return $result;
    }

    private function getBindType($value) {
        if (is_int($value)) {
            return "i";
        } elseif (is_float($value)) {
            return "d";
        } else {
            return "s";
        }
    }

    public function search($critere, $val)
    {
        $sql = "SELECT * FROM `jours` WHERE `$critere` = ?";
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