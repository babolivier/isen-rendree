<?php

require_once("connector.class.php");

class Document
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
        ));

        if(!$document)
        {
            throw new LengthException("Le fichier n'existe pas");
        }

        $document = $document[0];

        $this->id = $document["id"];
        $this->rang = $document["rang"];
        $this->promo = $document["promo"];
        $this->libelle = $document["libelle"];
        $this->fichier = $document["fichier"];
    }

    public static function addDocument($document, $options)
    {
        $filename = $document["name"];

        // Check for upload error
        if($document["error"])
        {
            throw new InvalidArgumentException("Une erreur s'est produite lors de l'envoi du fichier (".$document["error"].")");
        }

        // Determining the folder to put the document in
        if(strstr($filename, "A1") || strstr($filename, "A2"))
        {
            $destination = "A12/".$filename;
        }
        elseif(strstr($filename, "A3") || strstr($filename, "A4") || strstr($filename, "A5"))
        {
            $destination = "A345/".$filename;
        }
        else
        {
            $destination = $filename;
        }

        move_uploaded_file($document["tmp_name"], __DIR__."../../pdf/".$destination);

        foreach($options as $key=>$value)
        {
            if(empty($value) && $key != "promo")
            {
                throw new InvalidArgumentException("La colonne `".$key."` doit être définie");
            }
        }
        $bdd = new Connector();
        $bdd->Insert("document", array(
            "rang" => $options["rang"],
            "promo" => $options["promo"],
            "libelle" => $options["libelle"],
            "fichier" => $destination
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
        ));

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