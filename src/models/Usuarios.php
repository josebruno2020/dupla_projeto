<?php
class Usuarios extends Model {

    public function isLogged() {
        if(empty($_SESSION['lgusuario'])) {
            return false;
        } else {
            return true;
        }
    }

    public function fazerLogin($email, $senha){
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $_SESSION['lgusuario'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }
    
}