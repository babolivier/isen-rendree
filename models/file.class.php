<?php

require_once("connector.class.php");

class File
{
    private $id;
    private $rang;
    private $promo;
    private $libelle;
    private $fichier;

    function __construct($id)
    {
        $bdd = new Connector();
        $document = $bdd->Select("*", "document", array(
            "where" => array(
                array("id", "=", $id)
            )
        ))[0];

        if(!$document)
        {
            throw new LengthException("Le fichier n'existe pas");
        }

        $this->id = $document["id"];
        $this->rang = $document["rang"];
        $this->promo = $document["promo"];
        $this->libelle = $document["libelle"];
        $this->fichier = $document["fichier"];
    }

    public static function addDocument($document)
    {
        foreach($document as $key=>$value)
        {
            if(empty($value) && $key != "promo" && $key != "id")
            {
                throw InvalidArgumentException("La colonne `".$key."` doit être définie");
            }
        }
        $bdd = new Connector();
        $bdd->Insert("document", array(
            "id" => $document["id"],
            "rang" => $document["rang"],
            "promo" => $document["promo"],
            "libelle" => $document["libelle"],
            "fichier" => $document["fichier"]
        ));
    }

    function erase()
    {
        $bdd = new Connector();
        $bdd->Delete("document", array(array("id", "=", $this->id)));
        unlink(__DIR__."/../../pdf/".$this->fichier);
    }

    function changePromo($newPromo)
    {
        $bdd = new Connector();

        // Check if promo exists
        $promo = $bdd->Select("*", "promo", array(
            "where" => array(
                array("promo_id", "=", $newPromo)
            )
        ))[0];

        if(!$promo)
        {
            throw new LengthException("La promo n'existe pas");
        }

        // Change promo in both object and BDD
        $this->promo = $newPromo;

        $bdd->Update("document", array(
            "promo" => $this->promo
        ));
    }

    function changeRank($newRank)
    {
        $bdd = new Connector();

        // Change promo in both object and BDD
        $this->rang = $newRank;

        $bdd->Update("document", array(
            "rang" => $this->rang
        ));
    }
}