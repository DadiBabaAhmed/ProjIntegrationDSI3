<?php
session_start();
    class Etudiant {
        private $db;
    
        public function __construct($db) {
            $this->db = $db;
        }
    
        public function create($nom, $dateNais, $ncin, $nce, $typBac, $prenom, $sexe, $lieuNais, $adresse, $ville, $codePostal, $tel, $codClasse, $decision, $anneeUnversitaire, $semestre, $dispenser, $anneesopt, $dateInscription, $gouvernorat, $mentionBac, $nationalite, $codeCNSS, $nomArabe, $prenomArabe, $lieuNaisArabe, $adresseArabe, $villeArabe, $gouvernoratArabe, $typeBacAB, $photo, $origine, $situationDpart, $nbac, $redaut) {            
            $req="insert into etudiant values ('$nom', '$dateNais', '$ncin', '$nce', '$typBac', '$prenom', '$sexe', '$lieuNais', '$adresse', '$ville', '$codePostal', '$tel', '$codClasse', '$decision', '$anneeUnversitaire', '$semestre', '$dispenser', '$anneesopt', '$dateInscription', '$gouvernorat', '$mentionBac', '$nationalite', '$codeCNSS', '$nomArabe', '$prenomArabe', '$lieuNaisArabe', '$adresseArabe', '$villeArabe', '$gouvernoratArabe', '$typeBacAB', '$photo', '$origine', '$situationDpart', '$nbac', '$redaut')";
            $stmt = $this->db->prepare($req);
            $stmt->execute();
            $stmt->close();
        }
    
        public function read() {
            $sql = "SELECT * FROM etudiant";
            $result = $this->db->query($sql);
            return $result;
        }
    
        public function update($ncin, $newDataArray) {
            $setClauses = [];
            $bindValues = [];
            $types = '';
        
            foreach ($newDataArray as $field => $value) {
                $setClauses[] = "`$field` = ?";
                $bindValues[] = $value;
                $types .= $this->getBindType($value);
            }
        
            $bindValues[] = $ncin;
        
            $setClause = implode(', ', $setClauses);
            $sql = "UPDATE `etudiant` SET $setClause WHERE `NCIN` = ?";
        
            $stmt = $this->db->prepare($sql);
        
            if ($stmt) {
                $stmt->bind_param($types . 's', ...$bindValues);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Error in SQL statement: " . $this->db->error;
            }
        }
    
        public function delete($ncin) {
            $sql = "DELETE FROM etudiant WHERE NCIN = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("s", $ncin);
            $stmt->execute();
            $stmt->close();
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
        public function filterEtudiants($filterValues) {
            $sql = "SELECT * FROM etudiant WHERE 1";
        
            $bindTypes = "";
            $bindParams = [];
            $bindValues = [];
        
            if (!empty($filterValues)) {
                foreach ($filterValues as $key => $value) {
                    if ($key === "dispenser") {
                        $sql .= " AND $key = ?";
                        $bindTypes .= "s";
                        $bindValues[] = ($value === "on") ? "1" : "0";
                    } else {
                        $sql .= " AND $key = ?";
                        $bindTypes .= "s";
                        $bindValues[] = $value;
                    }
                }
            }
        
            $stmt = $this->db->prepare($sql);
        
            if ($stmt) {
                if (!empty($bindValues)) {
                    $stmt->bind_param($bindTypes, ...$bindValues);
                }
                $stmt->execute();
                return $stmt->get_result();
            } else {
                echo "Error in SQL statement: " . $this->db->error;
            }
        }
        
        public function getAllMatEtud(){
            $sql = "SELECT NCE,NCIN FROM etudiant";
            $result = $this->db->query($sql);
            $mat = [];
            while ($row = $result->fetch_assoc()) {
                $mat[] = $row;
            }
            return $mat;
        }
}
    
?>