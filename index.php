<?php include ("User.php");?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Objet</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php 
    $TableauUser = array();
    try{ $bdd = new PDO('mysql:host=localhost;dbname=User', 'root', 'root');
        $req = "SELECT * from User";
        $reponses = $bdd->query($req);
            while ($donnees = $reponses->fetch())
            {
                array_push($TableauUser,new User($donnees['id'],$donnees['login'],$donnees['mdp']));
            } 

        } catch (Exception $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
        }
    ?>
    <form action="" method="Post">
            Login: <input type="text" name="login">
            mdp: <input type="text" name="mdp">
            <input type="submit" name="connexion" value="ok">
    </form>

    <?php 

    if(isset($_POST["connexion"])){

           //1) rechercher le bon user dans $TableauUser
            $trouve = false;
            foreach ($TableauUser as  $TheUser) {
                //si le user du formulaire = le nom d'un user dans la liste alors on vérifi mdp
                if($TheUser->getNom()==$_POST['login']){
                    $trouve = true;
                    //2) Vérifier le mdp
                    //on va vérifier le mdp du formulaire avec celui de user trouvé
                    if($TheUser->seConnecter($_POST['mdp'])){
                        ?>
                        <h2>Vous etes connect</h2>
                        <?php
                    }else{
                        ?>
                        <h2>Mauvais Mot de passe</h2>
                        <?php
                    }
                }
            }
            if(!$trouve){
                echo "User Inconnu vérifier othographe";
            }
    }          
?>
</body>
</html>