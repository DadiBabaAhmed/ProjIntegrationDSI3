<?php
class Classe
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getClasseNames()
    {
        $sql = "SELECT CodClasse  FROM classe";
        //assign result set
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    // Create a new classe
    public function addClass($codClasse, $intClasse, $departement, $optiOn, $niveau, $intCalsseArabB, $optionAaraB, $departementAaraB, $niveauAaraB, $codeEtape, $codeSalima)
    {
        $sql = "INSERT INTO classe (CodClasse, IntClasse, Département, Opti_on, Niveau, IntCalsseArabB, OptionAaraB, DepartementAaraB, NiveauAaraB, CodeEtape, CodeSalima) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "sssssssssss",
            $codClasse,
            $intClasse,
            $departement,
            $optiOn,
            $niveau,
            $intCalsseArabB,
            $optionAaraB,
            $departementAaraB,
            $niveauAaraB,
            $codeEtape,
            $codeSalima
        );
        $stmt->execute();
        return true;
    }

    // Retrieve all classes
    public function getClasses()
    {
        $sql = "SELECT * FROM classe";
        $result = $this->db->query($sql);
        return $result;
    }

    // Retrieve a specific class by ID
    public function getClassById($id)
    {
        $sql = "SELECT * FROM classe WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update an existing class
    public function updateClass($id, $newData)
    {
        $sql = "UPDATE classe SET CodClasse=?, IntClasse=?, Département=?, Opti_on=?, Niveau=?, IntCalsseArabB=?, OptionAaraB=?, DepartementAaraB=?, NiveauAaraB=?, CodeEtape=?, CodeSalima=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "sssssssssssi",
            $newData["CodClasse"],
            $newData["IntClasse"],
            $newData["Département"],
            $newData["Opti_on"],
            $newData["Niveau"],
            $newData["IntCalsseArabB"],
            $newData["OptionAaraB"],
            $newData["DepartementAaraB"],
            $newData["NiveauAaraB"],
            $newData["CodeEtape"],
            $newData["CodeSalima"],
            $id
        );
        $stmt->execute();
        return true; 
    }

    // Delete a class
    public function deleteClass($id)
    {
        $sql = "DELETE FROM classe WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return true;
    }

    private function getBindType($value)
    {
        if (is_int($value)) {
            return "i";
        } elseif (is_double($value)) {
            return "d";
        } else {
            return "s";
        }
    }
    // Inside the Classe class

    public function search($search)
    {
        $query = "SELECT * FROM classe WHERE
              CodClasse LIKE '%$search%'
              OR IntClasse LIKE '%$search%'
              OR Département LIKE '%$search%'
              OR Opti_on LIKE '%$search%'
              OR Niveau LIKE '%$search%'
              OR CodeEtape LIKE '%$search%'
              OR CodeSalima LIKE '%$search%'";

        $result = $this->db->query($query);
        $classes = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $classes[] = $row;
            }
        }

        return $classes;
    }

}
?>

