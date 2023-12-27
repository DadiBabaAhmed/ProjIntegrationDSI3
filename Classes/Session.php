<?php

class Session
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //get all sessions

    public function getAllSessions()
    {
        $this->db->query("SELECT * FROM session");
        //assign result set
        $results = $this->db->resultSet();
        return $results;
    }

    public function getAllAnne()
    {
        $this->db->query("SELECT distinct Annee FROM session");
        //assign result set
        $results = $this->db->resultSet();
        return $results;
    }

    public function getByAnnee($Annee)
    {
        $this->db->query("SELECT * FROM session WHERE Annee = :Annee");
        $this->db->bind(':Annee', $Annee);
        //assign result set
        $results = $this->db->resultset();
        return $results;

    }
    public function getNumero()
    {
        $this->db->query("SELECT Numero FROM session");
        //assign result set
        $results = $this->db->single();
        return $results;
    }

    public function getSession($Numero)
    {
        $this->db->query("SELECT * FROM session WHERE Numero = :Numero");
        $this->db->bind(':Numero', $Numero);
        //assign result set
        $results = $this->db->single();
        return $results;
    }

    public function deleteSession($Numero)
    {
        $this->db->query("DELETE FROM session WHERE Numero = :Numero");
        $this->db->bind(':Numero', $Numero);
        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateSession($Numero, $data)
    {
        $this->db->query("UPDATE session 
        SET Annee = :Annee, Sem = :Sem, SemAb = :SemAb, Debut = :Debut, Fin = :Fin, Debsem = :Debsem, Finsem = :Finsem, Annea = :Annea, Anneab = :Anneab 
        WHERE Numero = :Numero");
        //bind data
        $this->db->bind(':Numero', $Numero);
        $this->db->bind(':Annee', $data['Annee']);
        $this->db->bind(':Sem', $data['Sem']);
        $this->db->bind(':SemAb', $data['SemAb']);
        $this->db->bind(':Debut', $data['Debut']);
        $this->db->bind(':Fin', $data['Fin']);
        $this->db->bind(':Debsem', $data['Debsem']);
        $this->db->bind(':Finsem', $data['Finsem']);
        $this->db->bind(':Annea', $data['Annea']);
        $this->db->bind(':Anneab', $data['Anneab']);


        //assign result set
        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function create($data)
    {
        //insert query
        $this->db->query("INSERT INTO session (Annee, Sem, SemAb, Debut, Fin, Debsem, Finsem, Annea, Anneab) 
        VALUES (:Annee, :Sem, :SemAb, :Debut, :Fin, :Debsem, :Finsem, :Annea, :Anneab)");
        //bind data
        $this->db->bind(':Annee', $data['Annee']);
        $this->db->bind(':Sem', $data['Sem']);
        $this->db->bind(':SemAb', $data['SemAb']);
        $this->db->bind(':Debut', $data['Debut']);
        $this->db->bind(':Fin', $data['Fin']);
        $this->db->bind(':Debsem', $data['Debsem']);
        $this->db->bind(':Finsem', $data['Finsem']);
        $this->db->bind(':Annea', $data['Annea']);
        $this->db->bind(':Anneab', $data['Anneab']);
        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }
}