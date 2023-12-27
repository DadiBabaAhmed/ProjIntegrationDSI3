<?php
class Gouvernorat{
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
            $sql = "INSERT INTO gouvernorats ($columns) VALUES ($placeholders)";
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

    public function update($Gouv, $newDataArray)
    {
        $setClauses = [];
        $bindValues = [];
        $types = '';
    
        foreach ($newDataArray as $field => $value) {
            $setClauses[] = "`$field` = ?";
            $bindValues[] = $value;
            $types .= $this->getBindType($value);
        }
    
        $bindValues[] = $Gouv;
    
        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE `gouvernorats` SET $setClause WHERE `Gouv` = ?";
    
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

    public function delete($Gouv)
    {
        $sql = "DELETE FROM `gouvernorats` WHERE `Gouv` = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $Gouv);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
        }
        return false;
    }

    public function getGovernorat($Gouv)
    {
        $sql = "SELECT * FROM `gouvernorats` WHERE `Gouv` = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $Gouv);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_assoc();
            }
        }
        return false;
    }

    public function getGovernorats()
    {
        $sql = "SELECT * FROM `gouvernorats`";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
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
        $sql = "SELECT * FROM `gouvernorats` WHERE `$critere` = ?";
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

    public function getAllCodes()
    {
        $sql = "SELECT `Gouv` FROM `gouvernorats`";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>