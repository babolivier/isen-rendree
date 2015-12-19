Note : Ce readme est rédigé en utilisant la syntaxe markdown. Il reste compréhensible, mais est plus agréable à lire ici : https://github.com/babolivier/isen-rentree/blob/master/readme.md

# Rentrée ISEN Brest : Administration
## Guide d'installation

### Modifications sur l'application existante
Afin que l'application fonctionne, il vous faudra effectuer les modifications suivantes dans le fichier `config.php`, à la racine de l'application existante :

Remplacer
```
// informations concernant la base de données
$DbHost = "127.0.0.1";
$DbName = "à compléter...";
$DbUser = "à compléter...";
$DbPassword = "à compléter..."; 
```
par
```
require_once("DbIds.php");
$ids = getParams();
```

 Remplacer
```
$libellePromo = array (
    "1&#x02B3;&#x1D49; année, Cycle Sciences de l'Ingénieur" => "CSI_A1",
    "1&#x02B3;&#x1D49; année, Cycle Informatique et Réseaux (Brest)" => "CIR_BREST_A1",
    "1&#x02B3;&#x1D49; année, Cycle Informatique et Réseaux (Rennes)" => "CIR_RENNES_A1",        
    "1&#x02B3;&#x1D49; année, BTS Prépa" => "BTSPREPA_A1",    
    "2&#x1D49; année, Cycle Sciences de l'Ingénieur" => "CSI_A2",
    "2&#x1D49; année, Cycle Informatique et Réseaux (Brest)" => "CIR_BREST_A2",
    "2&#x1D49; année, Cycle Informatique et Réseaux (Rennes)" => "CIR_RENNES_A2",        
    "2&#x1D49; année, BTS Prépa" => "BTSPREPA_A2",     
    "3&#x1D49; année, Cycle Sciences de l'Ingénieur" => "CSI_A3",
    "3&#x1D49; année, Cycle Informatique et Réseaux (alternant)" => "CIR_A3_ALT",
    "3&#x1D49; année, Cycle Informatique et Réseaux (non alternant)" => "CIR_A3_NONALT",    
    "3&#x1D49; année, Cycle Ingénieur Par l'Apprentissage" => "CIPA_A3",
    "4&#x1D49; année, Majeure - M1" => "M_A4",
    "4&#x1D49; année, Cycle Ingénieur Par l'Apprentissage" => "CIPA_A4",
    "5&#x1D49; année, Majeure - M2 (alternant)" => "M_A5_ALT",
    "5&#x1D49; année, Majeure - M2 (non alternant)" => "M_A5_NONALT",    
    "5&#x1D49; année, Cycle Ingénieur Par l'Apprentissage" => "CIPA_A5"
);
```
par
```
$bdd = new PDO("mysql:host=$ids[0];dbname=$ids[1]", $ids[2], $ids[3]);
$stmt = $bdd->prepare("SELECT * FROM promo ORDER BY libelle");
$stmt->execute();

$libellePromo = array();
foreach($stmt->fetchAll() as $promo) {
    $libellePromo[$promo["libelle"]] = $promo["id_promo"];
}
```

Vous devrez aussi créer et remplir le fichier `DbIds.php` (à la racine de l'application existante), qui contiendra vos identifiants de connexion à la base de données de la façon suivante :
```
<?php

function getParams() {
    // informations concernant la base de données
    $DbHost = "[DB_HOST]";
    $DbName = "[DB_NAME]";
    $DbUser = "[DB_USER]";
    $DbPassword = "[DB_PASSWORD]";

    return [$DbHost, $DbName, $DbUser, $DbPassword];
}
```
Veillez bien à remplacer `[DB_HOST]`, `[DB_NAME]`, `[DB_USER]` et `[DB_PASSWORD]` par les valeurs correspondates.

Enfin, chargez fichier `database.sql` situé dans le même dossier que ce "readme", dans votre base de données.

### Installation de l'application d'administration
Pour installer l'application d'administration, il vous suffit de déplacer le dossier "admin" situé dans le même dossier que le présent "readme" dans le dossier racine de l'application existante. Vous pouvez le renommer comme vous le voudrez.

Pour accéder à l'application, ouvrez votre navigateur à l'adresse `http(s)://[APP_EXISTANTE]/[NOM_ADMIN]`, où `[APP_EXISTANTE]` est l'adresse de l'application existante, et `[NOM_ADMIN]` est le nom du dossier contenant l'application d'administration (`admin` si vous ne l'avez pas renommé).
