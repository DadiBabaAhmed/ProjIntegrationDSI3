<?php
class ProfSituation{
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
            $sql = "INSERT INTO `profsituation` (`$columns`) VALUES ($placeholders)";
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

    public function update($CodeProf, $newDataArray)
    {
        $setClauses = [];
        $bindValues = [];
        $types = '';
    
        foreach ($newDataArray as $field => $value) {
            $setClauses[] = "`$field` = ?";
            $bindValues[] = $value;
            $types .= $this->getBindType($value);
        }
    
        $bindValues[] = $CodeProf;
    
        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE `profsituation` SET $setClause WHERE `CodeProf` = ?";
    
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

    public function delete($CodeProf)
    {
        $sql = "DELETE FROM `profsituation` WHERE `CodeProf` = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $CodeProf);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
        }
        return false;
    }

    public function getAllProfSituation()
    {
        $sql = "SELECT * FROM `profsituation`";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return false;
    }

    public function getProfSituation($CodeProf)
    {
        $sql = "SELECT * FROM `profsituation` WHERE `CodeProf` = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $CodeProf);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_assoc();
            }
        }
        return false;
    }

    private function getBindType($var)
    {
        switch (gettype($var)) {
            case 'string':
                return 's';
            case 'integer':
                return 'i';
            case 'double':
                return 'd';
            default:
                return 'b';
        }
    }

    public function search($critere, $val)
    {
        $sql = "SELECT * FROM `profsituation` WHERE `$critere` = ?";
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