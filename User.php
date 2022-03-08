<?php echo "Chargement class User";

class User{
    //Propriétes (private)
    private $login_;
    private $mdp_;

    //Méthode (public)
    public function __construct($NewLogin, $pass){
        $this->login_ = $NewLogin;
        $this->mdp_ = $pass;
    }
    public function getNom(){
       return $this->login_;
    }
    public function SeConnecter($UnMotDePasse){ 
        if($UnMotDePasse==$this->mdp_){
            return true;
        }
        else{
            return false;
        }
    }
}
    





?>