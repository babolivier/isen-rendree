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
        ));

        if($promo == NULL)
        {
            throw new LengthException("La promo n'existe pas");
        }

        $promo = $promo[0];

        $this->id_promo = $promo["id_promo"];
        $this->libelle = $promo["libelle"];
    }

    public static function getAll()
    {
        $bdd = new Connector();
        $promos = $bdd->Select("*", "promo");
        $toReturn = array();

        foreach ($promos as $promo) {
            $doc = new Promo($promo["id_promo"]);
            array_push($toReturn, self::toArray($doc));
        }

        return $toReturn;
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
        ));

        if(!$promo)
        {
            throw new UnexpectedValueException("La promo n'existe plus en base de données");
        }

        $promo = $promo[0];

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

    public static function toArray($promo)
    {
        return array(
            "Identifiant" => $promo->id_promo,
            "Libellé" => $promo->libelle
        );
    }
}