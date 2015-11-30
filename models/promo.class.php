<?php

require_once("connector.class.php");

class Promo
{
    private $id_promo;
    private $libelle;

    function __construct($id)
    {
        $bdd = new Connector();
        $promo = $bdd->Select("*", "promo", array(
            "where" => array(
                array("id_promo", "=", $id)
            )
        ))[0];

        if($promo == NULL)
        {
            throw new LengthException("La promo n'existe pas");
        }

        $this->id_promo = $promo["id_promo"];
        $this->libelle = $promo["libelle"];
    }

    public static function getAll()
    {
        $bdd = new Connector();
        return $bdd->Select("*", "promo");
    }

    /**
     * @return mixed
     */
    public function getIdPromo()
    {
        return $this->id_promo;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $id_promo
     */
    public function setIdPromo($id_promo)
    {
        $this->id_promo = $id_promo;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    function write()
    {
        $bdd = new Connector();

        $promo = $bdd->Select("*", "promo", array(
            "where" => array(
                array("id_promo", "=", $this->id_promo)
            )
        ))[0];

        if(!$promo)
        {
            throw new UnexpectedValueException("La promo n'existe plus en base de données");
        }

        $attrs = get_object_vars($this);
        $toUpdate = array();

        foreach ($attrs as $key => $value) {
            if ($value != $promo[$key]) {
                $toUpdate[$key] = $value;
            }
        }

        $bdd->Update("promo", array(
            "set" => $toUpdate,
            "where" => array(array("id_promo", "=", $this->id_promo))
        ));
    }

    function erase()
    {
        $bdd = new Connector();
        $bdd->Delete("promo", array(array("id_promo", "=", $this->id_promo)));
    }

    public static function addPromo($promo)
    {
        $bdd = new Connector();
        $bdd->Insert("promo", array(
            "id_promo" => $promo["id"],
            "libelle" => $promo["libelle"]
        ));
    }
}