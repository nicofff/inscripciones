<?php

class Inscripto {

    public function __construct ($data){
        $this->apellido = $data["apellido"];
        $this->nombre = $data["nombre"];
        $this->email = $data["email"];
        $this->tipoDoc = $data["tipoDoc"];
        $this->numerDoc = $data["numeroDoc"];
        $this->paisNac = $data["paisNac"];
        $this->profesion = $data["profesion"];
        $this->especialidad= $data["especialidad"];
        $this->paisRes = $data["paisRes"];
        $this->provincia = $data["provincia"];
        $this->domicilio = $data["domicilio"];
        $this->codigoPostal = $data["codigoPostal"];

        return $this;
    }

    public function estaRegistrado(){
        include "dbConn.php"; # me da el obj $MYSQLI
        $query= "SELECT count(*) as total from Inscriptos where TipoDoc = ". $this->tipoDoc ." AND NumeroDoc = ".$this->numerDoc;
        if ($result = $MYSQLI->query($query)){
            $resObj = $result->fetch_object();
            $total=$resObj->total;
            if ($total == 0 ){
                return false;
            }
            else{
                return true;
            }
        } else {
            die();
        }
    }

    public function validate (){
        if (($this->apellido = filter_var($this->apellido, FILTER_SANITIZE_STRING)) == ""){

            return false;
        }
        if (($this->nombre = filter_var($this->nombre, FILTER_SANITIZE_STRING)) == ""){
            return false;
        }
        if (!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            return false;
        }
        if (!filter_var($this->paisNac,FILTER_VALIDATE_INT)){
            return false;
        }
        if (!filter_var($this->profesion,FILTER_VALIDATE_INT)){
            return false;
        }
        if (($this->especialidad = filter_var($this->especialidad, FILTER_SANITIZE_STRING)) == ""){
            return false;
        }
        if (!filter_var($this->paisRes,FILTER_VALIDATE_INT)){
            return false;
        }
        if (($this->provincia = filter_var($this->provincia, FILTER_SANITIZE_STRING)) == ""){
            return false;
        }
        if (($this->domicilio = filter_var($this->domicilio, FILTER_SANITIZE_STRING)) == ""){
            return false;
        }
        if (($this->codigoPostal = filter_var($this->codigoPostal, FILTER_SANITIZE_STRING)) == ""){
            return false;
        }
        return true;
    }

    public function save(){
        include "dbConn.php"; # me da el obj $MYSQLI
        $query= "INSERT INTO Inscriptos (Apellido,Nombre,TipoDoc,NumeroDoc,PaisNac,Profesion,Especialidad,PaisRes,Provincia,Domicilio,CodigoPostal,Email) ";
        $query.= "VALUES ('".$this->apellido."','".$this->nombre."',".$this->tipoDoc.",".$this->numerDoc.",".$this->paisNac.",".$this->profesion.",'".$this->especialidad;
        $query .= "',".$this->paisRes.",'".$this->provincia."','".$this->domicilio."','".$this->codigoPostal."','".$this->email."')";
        echo $query;
        $MYSQLI->query($query);
        if (mysqli_error($MYSQLI)){
            return false;
        }else{
            return true;
        }
    }
    
    public static function getAll() {
        include "dbConn.php"; # me da el obj $MYSQLI
        $query= "SELECT I.Apellido,I.Nombre,I.TipoDoc,I.NumeroDoc,P1.Nombre as PaisNac,PR.Nombre as Profesion,I.Especialidad,P2.Nombre as PaisRes,I.Provincia,I.Domicilio,I.CodigoPostal,I.Email ";
        $query.= "from Inscriptos I, Paises P1 , Paises P2, Profesion PR ";
        $query.= "where P1.id = I.PaisNac AND P2.id = I.paisRes AND I.Profesion = PR.ID";
        if ($result = $MYSQLI->query($query)){
            $json = array();
            while (($resObj = $result->fetch_object())!= NULL){
                $json[]=$resObj;
            }
            return json_encode($json);
        } else {
            die();
        }
    }

}