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
        $sql="SELECT CodClasse  FROM classe";
        //assign result set
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
