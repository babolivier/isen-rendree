<?php

require_once("connector.class.php");

class Data
{
    private $identifiant;
    private $nom_fils;
    private $prenom_fils;
    private $ddn_fils;
    private $tel_mobile;
    private $courriel;
    private $date;
    private $ip;

    function __construct($id)
    {
        $bdd = new Connector();

        $data = $bdd->Select("*", "data", array(
            "where" => array(
                array("id", "=", $id)
            )
        ));

        if($data == NULL)
        {
            throw new LengthException("Les données n'existent pas");
        }

        $data = $data[0];

        // Chargement des informations
        $this->identifiant = $data["identifiant"];
        $this->nom_fils = $data["nom_fils"];
        $this->prenom_fils = $data["prenom_fils"];
        $this->ddn_fils = $data["ddn_fils"];
        $this->tel_mobile = $data["tel_mobile"];
        $this->courriel = $data["courriel"];
        $this->date = $data["date"];
        $this->ip = $data["ip"];
    }

    /**
     * @return string
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * @return string
     */
    public function getNomFils()
    {
        return $this->nom_fils;
    }

    /**
     * @return string
     */
    public function getPrenomFils()
    {
        return $this->prenom_fils;
    }

    /**
     * @return string
     */
    public function getDdnFils()
    {
        return $this->ddn_fils;
    }

    /**
     * @return string
     */
    public function getTelMobile()
    {
        return $this->tel_mobile;
    }

    /**
     * @return string
     */
    public function getCourriel()
    {
        return $this->courriel;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $identifiant
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    }

    /**
     * @param string $nom_fils
     */
    public function setNomFils($nom_fils)
    {
        $this->nom_fils = $nom_fils;
    }

    /**
     * @param string $prenom_fils
     */
    public function setPrenomFils($prenom_fils)
    {
        $this->prenom_fils = $prenom_fils;
    }

    /**
     * @param string $ddn_fils
     */
    public function setDdnFils($ddn_fils)
    {
        $this->ddn_fils = $ddn_fils;
    }

    /**
     * @param string $tel_mobile
     */
    public function setTelMobile($tel_mobile)
    {
        $this->tel_mobile = $tel_mobile;
    }

    /**
     * @param string $courriel
     */
    public function setCourriel($courriel)
    {
        $this->courriel = $courriel;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    function write()
    {
        $bdd = new Connector();

        $data = $bdd->Select("*", "data", array(
            "where" => array(
                array("identifiant", "=", $this->identifiant)
            )
        ));

        if(!$data)
        {
            throw new UnexpectedValueException("Les données n'existent plus en base de données");
        }

        $data = $data[0];

        $attrs = get_object_vars($this);
        $toUpdate = array();

        foreach ($attrs as $key => $value) {
            if ($value != $data[$key]) {
                $toUpdate[$key] = $value;
            }
        }

        $bdd->Update("data", array(
            "set" => $toUpdate,
            "where" => array(array("identifiant", "=", $this->identifiant))
        ));
    }

    public static function extract()
    {
        $bdd = new Connector();
        $data = $bdd->Select("*", "data");

        if(!$data)
        {
            throw new LengthException("Aucune donnée présente en base de données");
        }

        $csv = "";

        // Head line
        $keys = array();
        foreach ($data[0] as $key => $value) {
            array_push($keys, $key);
        }
        $csv .= implode(",", $keys) . "\n";

        // Content
        foreach ($data as $student) {
            $csv .= implode(",", $student);
            $csv .= "\n";
        }

        return $csv;
    }

    public static function getAll()
    {
        $bdd = new Connector();
        $datas = $bdd->Select("*", "data");
        $toReturn = array();

        foreach ($datas as $data) {
            $doc = new Data($data["id"]);
            array_push($toReturn, self::toArray($doc));
        }

        return $toReturn;
    }

    function erase()
    {
        $bdd = new Connector();
        $bdd->Delete("data", array(array("identifiant", "=", $this->identifiant)));
    }

    public static function toArray($data)
    {
        return array(
            "Identifiant" => $data->identifiant,
            "Nom" => $data->nom_fils,
            "Prénom" => $data->prenom_fils,
            "Date de naissance" => $data->ddn_fils,
            "Téléphone portable" => $data->tel_mobile,
            "Adresse courriel du parent" => $data->courriel,
            "Date d'enregistrement" => $data->date,
            "Adresse IP" => $data->ip
        );
    }
}