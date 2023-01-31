<?php
$vaarin = "";

$vuosisataMerkit = array('+','-','A','B','C','D','E','F','Y','X','W','U');
$tarkistusLuvut = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','H','J','K','L','M','N','P','R','S','T','U','V','W','X','Y');
if(!empty($_POST)){
    $henkilotunnus = $_POST['henkilotunnus'];
    $kuukaudet = array(31,((substr($henkilotunnus,4,2))%4 == 0) ? 29 : 28,31,30,31,30,31,31,30,31,30,31);
    if ((strlen($henkilotunnus)!=11 && ($henkilotunnus != null))){ //katsoo onko henkilötunnus oikean pituinen
    $vaarin = "henkilötunnus on väärän pituinen";
}elseif(empty($henkilotunnus)){
    $vaarin = "syötä henkilötunnus";
}elseif(!is_numeric(substr($henkilotunnus,0,6)) || !is_numeric(substr($henkilotunnus,7,3))){
    $vaarin = "0-6 ja/tai 8-10 riveillä pitäisi olla numeroita";
}
else{//tarkistaa onko viimeinen merkki oikea
    $viimeinen = (substr($henkilotunnus,0,6) . substr($henkilotunnus,7,3))%31;
if (substr($henkilotunnus,10,1)!=$tarkistusLuvut[$viimeinen]){
        $vaarin = "viimeinen merkki on väärin";
    
}
if($karkausvuosi = ((substr($henkilotunnus,4,2))%4 == 0)){
    $karkausvuosi = 29;
}else{
    $karkausvuosi = 28;
}

$lista3 = array(31,$karkausvuosi,31,30,31,30,31,31,30,31,30,31);
if ((substr($henkilotunnus,0,2)>$kuukaudet[(substr($henkilotunnus,2,2)<13)]) || (substr($henkilotunnus,0,2)<1)){//katsoo onko ensimmäinen ja toinen numero oikeat
    $vaarin = "ensimmäinen ja/tai toinen numero on väärin";

}
if ((substr($henkilotunnus,2,2)>12) || (substr($henkilotunnus,2,2)<1)){ //katsoo onko kolmas ja neljäs numero oikeat
    $vaarin = "kolmas ja/tai neljäs numero on väärin";
}
if (in_array((substr($henkilotunnus,6,1)),$vuosisataMerkit)==false){//katsoo laitatko vuosisadan tunnuksen
    $vaarin ="Seitsemäsmerkki on väärin";
}
if (substr($henkilotunnus,7,3) < 2){//tarkistaa kahdeksannen, yhdeksännen ja kymmenennen numeron
    $vaarin = "kahdeksas ja/tai yhdeksäs ja/tai kymmenes numero on väärin";
}
}

if($vaarin != ""){
    echo $vaarin;
}else{
    echo "Henkilötunnus kelpaa";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="henkilotunnustarkistus.php" method="POST">
    <div>
    henkilötunnus: <input id="henkilotunnus" name="henkilotunnus" type="text"><br>
    </div>
    <div>
    <input type="submit">
    </div>
</form>
</body>
</html>
