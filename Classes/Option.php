<?php
class Option
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

            $sql = "INSERT INTO options ($columns) VALUES ($placeholders)";
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

    public function update($Code_Option, $newDataArray)
    {
        $setClauses = [];
        $bindValues = [];
        $types = '';
    
        foreach ($newDataArray as $field => $value) {
            $setClauses[] = "`$field` = ?";
            $bindValues[] = $value;
            $types .= $this->getBindType($value);
        }
    
        $bindValues[] = $Code_Option;
    
        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE `options` SET $setClause WHERE `Code_Option` = ?";
    
        $stmt = $this->db->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param($types . 'i', ...$bindValues);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error in SQL statement: " . $this->db->error;
        }
    }

    public function delete($Code_Option)
    {
        $sql = "DELETE FROM options WHERE Code_Option = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $Code_Option);
        $stmt->execute();
        $stmt->close();
    }

    public function getOption($Code_Option)
    {
        $sql = "SELECT * FROM options WHERE Code_Option = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $Code_Option);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public function getAllOptions()
    {
        $sql = "SELECT * FROM options";
        $result = $this->db->query($sql);
        $Options = [];
        while ($row = $result->fetch_assoc()) {
            $Options[] = $row;
        }
        return $Options;
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
        $sql = "SELECT * FROM `options` WHERE `$critere` = ?";
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

    public function getOptionsNames()
    {
        $sql = "SELECT Code_Option, Option_Name FROM options";
        $result = $this->db->query($sql);
        $Options = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $Options[] = $row;
            }
        }

        return $Options;
    }

    public function getAllDepartements()
    {
        $sql = "SELECT DISTINCT `Departement ` FROM `options`";
        $result = $this->db->query($sql);
        $Departements = [];
        while ($row = $result->fetch_assoc()) {
            $Departements[] = $row;
        }
        return $Departements;
    }
}

?>