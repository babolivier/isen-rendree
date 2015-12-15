<?php

require_once("connector.class.php");
require_once("promo.class.php");

class Document
{
    private $id;
    private $rang;
    private $promo;
    private $libelle_promo;
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

        if (!$document) {
            throw new LengthException("Le fichier n'existe pas");
        }

        $document = $document[0];

        $this->id = $document["id"];
        $this->rang = $document["rang"];
        $this->promo = $document["promo"];
        $this->libelle = $document["libelle"];
        $this->fichier = $document["fichier"];

        if (isset($document["promo"])) {
            $promo = new Promo($document["promo"]);
            $this->libelle_promo = $promo->getLibelle();
        }
    }

    public static function getAll()
    {
        $bdd = new Connector();
        $documents = $bdd->Select("*", "document");
        $toReturn = array();

        foreach ($documents as $document) {
            $doc = new Document($document["id"]);
            array_push($toReturn, self::toArray($doc));
        }

        return $toReturn;
    }

    public static function addDocument($document, $options)
    {
        $filename = $document["name"];

        // Check for upload error
        if ($document["error"]) {
            throw new InvalidArgumentException("Une erreur s'est produite lors de l'envoi du fichier (" . $document["error"] . ")");
        }

        // Determining the folder to put the document in
        if (strstr($filename, "A1") || strstr($filename, "A2")) {
            error_log("A1\n");
            $destination = "A12/" . $filename;
        } elseif (strstr($filename, "A3") || strstr($filename, "A4") || strstr($filename, "A5")) {
            error_log("A3\n");
            $destination = "A345/" . $filename;
        } else {
            error_log("meh\n");
            $destination = $filename;
        }

        error_log($destination);

        move_uploaded_file($document["tmp_name"], __DIR__ . "../../pdf/" . $destination);

        foreach ($options as $key => $value) {
            if (empty($value) && $key != "promo") {
                throw new InvalidArgumentException("La colonne `" . $key . "` doit être définie");
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
        unlink(__DIR__ . "/../../pdf/" . $this->fichier);
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

        if (!$promo) {
            throw new LengthException("La promo n'existe pas");
        }

        // Change promo in both object and BDD
        $this->promo = $newPromo;
        $this->libelle_promo = $promo[0]["libelle"];

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

    public static function toArray($document)
    {
        return array(
            "Rang" => $document->rang,
            "Promotion" => array(
                "id" => $document->promo,
                "libelle" => $document->libelle_promo
            ),
            "Libellé" => $document->libelle,
            "Nom du fichier" => $document->fichier,
        );
    }
}