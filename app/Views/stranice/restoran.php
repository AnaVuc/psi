
<?php

foreach ($restoran as $res) {
    $suma=$res->brojRecenzija*$res->Prosecna_ocena;
    echo "<tr><td>{$res->Ime}</td> &nbsp <td>{$res->Vrsta_hrane}</td> <td><i>{$res->Prosecna_ocena}</i></td> <td><i>{$res->Cenovni_rang}</i></td> <td><b>$suma</b></td><br>";
}
?>