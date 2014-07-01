        <?php
include('../INCLUDES/conecta.php');
include_once('../INCLUDES/uses.php');
session_start();

echo "VetorVarreduraPranchasPrivadas = [];";
echo "VetorVarreduraPranchasPublicas = [];";

echo"tam_array_pranchas = '".sizeof($_SESSION['vetor_lista_pranchas'])."';";

for ($i=0; $i<sizeof($_SESSION['vetor_privadas']); $i++) { 
        echo "VetorVarreduraPranchasPrivadas[$i] = '".$_SESSION['vetor_privadas'][$i]."';"; //outputting javascript!
}

for ($i=0; $i<sizeof($_SESSION['vetor_publicas']); $i++) { 
        echo "VetorVarreduraPranchasPublicas[$i] = '".$_SESSION['vetor_publicas'][$i]."';"; //outputting javascript!
}

?>
