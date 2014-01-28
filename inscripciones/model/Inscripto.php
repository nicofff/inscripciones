<?php

class Inscripto {

    public function __construct($data) {
        $this->apellido = $data["apellido"];
        $this->nombre = $data["nombre"];
        $this->email = $data["email"];
        $this->tipoDoc = $data["tipoDoc"];
        $this->numeroDoc = $data["numeroDoc"];
        $this->paisNac = $data["paisNac"];
        $this->profesion = $data["profesion"];
        $this->especialidad = $data["especialidad"];
        $this->paisRes = $data["paisRes"];
        $this->provincia = $data["provincia"];
        $this->domicilio = $data["domicilio"];
        $this->codigoPostal = $data["codigoPostal"];
        if ($data["esBecado"] == 1) {
            $this->laboratorio = $data["laboratorio"];
        } else {
            $this->laboratorio = 0;
        }

        return $this;
    }

    public function estaRegistrado() {
        include "dbConn.php"; # me da el obj $MYSQLI
        $query = "SELECT * from Inscriptos where (TipoDoc = " . $this->tipoDoc . " AND NumeroDoc = " . $this->numeroDoc . ") OR Email = '" . $this->email . "'";
        if ($result = $MYSQLI->query($query)) {
            $resObj = $result->fetch_object();
            $MYSQLI->close();
            if ($result->num_rows == 0) {
                return false;
            }else{
                $this->email = $resObj->Email;
            }
        } else {
            die();
        }
    }

    public function validate() {
        if (($this->apellido = filter_var($this->apellido, FILTER_SANITIZE_STRING)) == "") {

            return false;
        }
        if (($this->nombre = filter_var($this->nombre, FILTER_SANITIZE_STRING)) == "") {
            return false;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        if (!filter_var($this->paisNac, FILTER_VALIDATE_INT)) {
            return false;
        }
        if (!filter_var($this->profesion, FILTER_VALIDATE_INT)) {
            return false;
        }
        if (($this->especialidad = filter_var($this->especialidad, FILTER_SANITIZE_STRING)) == "") {
            return false;
        }
        if (!filter_var($this->paisRes, FILTER_VALIDATE_INT)) {
            return false;
        }
        if (($this->provincia = filter_var($this->provincia, FILTER_SANITIZE_STRING)) == "") {
            return false;
        }
        if (($this->domicilio = filter_var($this->domicilio, FILTER_SANITIZE_STRING)) == "") {
            return false;
        }
        if (($this->codigoPostal = filter_var($this->codigoPostal, FILTER_SANITIZE_STRING)) == "") {
            return false;
        }
        return true;
    }

    public function save() {
        include "dbConn.php"; # me da el obj $MYSQLI
        $query = "INSERT INTO Inscriptos (Apellido,Nombre,TipoDoc,NumeroDoc,PaisNac,Profesion,Especialidad,PaisRes,Provincia,Domicilio,CodigoPostal,Email,Laboratorio,CodigoInscripcion) ";
        $query.= "VALUES ('" . $this->apellido . "','" . $this->nombre . "'," . $this->tipoDoc . "," . $this->numeroDoc . "," . $this->paisNac . "," . $this->profesion . ",'" . $this->especialidad;
        $query .= "'," . $this->paisRes . ",'" . $this->provincia . "','" . $this->domicilio . "','" . $this->codigoPostal . "','" . $this->email . "'," . $this->laboratorio . ", substring(uuid(),1,8))";
        $MYSQLI->query($query);
        if (mysqli_error($MYSQLI)) {
            print_r(mysqli_error($MYSQLI));
            die();
            return false;
        } else {
            $MYSQLI->close();
        }
    }

    public function update($id) {
        include "dbConn.php"; # me da el obj $MYSQLI
        $query = "UPDATE Inscriptos SET "; //(Apellido,Nombre,TipoDoc,NumeroDoc,PaisNac,Profesion,Especialidad,PaisRes,Provincia,Domicilio,CodigoPostal,Email,Laboratorio) ";
        $query.= "Apellido = '" . $this->apellido . "' ,";
        $query.= "Nombre = '" . $this->nombre . "' ,";
        $query.= "TipoDoc = '" . $this->tipoDoc . "' ,";
        $query.= "NumeroDoc = " . $this->numeroDoc . " ,";
        $query.= "PaisNac = " . $this->paisNac . " ,";
        $query.= "Profesion = " . $this->profesion . " ,";
        $query.= "Especialidad = '" . $this->especialidad . "' ,";
        $query.= "PaisRes = " . $this->paisRes . " ,";
        $query.= "Provincia = '" . $this->provincia . "' ,";
        $query.= "Domicilio = '" . $this->domicilio . "' ,";
        $query.= "CodigoPostal = '" . $this->codigoPostal . "' ,";
        $query.= "Email = '" . $this->email . "' ,";
        $query.= "Laboratorio = " . $this->laboratorio;
        $query.= " WHERE ID=" . $id;
        $MYSQLI->query($query);
        if (mysqli_error($MYSQLI)) {
            print_r(mysqli_error($MYSQLI));
            die();
            return false;
        } else {
            $MYSQLI->close();
            return true;
        }
    }

    public static function getAll() {
        include "dbConn.php"; # me da el obj $MYSQLI
        $query = "SELECT I.ID, I.Apellido,I.Nombre, T.Nombre as TipoDoc,I.NumeroDoc,P1.Nombre as PaisNac,PR.Nombre as Profesion,I.Especialidad,P2.Nombre as PaisRes,I.Provincia,I.Domicilio,I.CodigoPostal,I.Email, L.Nombre as Laboratorio, I.CodigoInscripcion ";
        $query.= "from Inscriptos I, Paises P1 , Paises P2, Profesion PR, TipoDoc T, Laboratorios L ";
        $query.= "where P1.id = I.PaisNac AND P2.id = I.paisRes AND I.Profesion = PR.ID and I.TipoDoc = T.ID and L.ID = I.Laboratorio";
        if ($result = $MYSQLI->query($query)) {
            $json = array();
            while (($resObj = $result->fetch_object()) != NULL) {
                $json[] = $resObj;
            }
            $MYSQLI->close();
            return json_encode($json);
        } else {
            die();
        }
    }

    public static function get($id) {
        include "dbConn.php"; # me da el obj $MYSQLI
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return false;
        }
        $query = "SELECT I.ID,I.Apellido as apellido,I.Nombre as nombre,I.TipoDoc as tipoDoc,I.NumeroDoc as numeroDoc,I.PaisNac as paisNac,I.Profesion as profesion,I.Especialidad as especialidad,I.PaisRes as paisRes,I.Provincia as provincia,I.Domicilio as domicilio,I.CodigoPostal as codigoPostal,I.Email as email, I.Laboratorio as laboratorio ";
        $query.= "from Inscriptos I ";
        $query.= "where I.ID=" . $id;
        if ($result = $MYSQLI->query($query)) {
            $result = $result->fetch_object();
            $MYSQLI->close();
            return json_encode($result);
        } else {
            die();
        }
    }

    public static function delete($id) {
        include "dbConn.php"; # me da el obj $MYSQLI
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return false;
        }
        $query = "Delete from Inscriptos where ID=" . $id;
        $MYSQLI->query($query);
        if (mysqli_error($MYSQLI)) {
            return false;
        } else {
            $MYSQLI->close();
            return true;
        }
    }

    public static function exportAll() {
        header("Content-type: text/csv; charset=UTF-8");
        header('Content-Disposition: attachment; filename=Export.csv');
        echo "'ID','Apellido','Nombre','Tipo Documento','Numero Documento','Pais Nacimiento','Profesion','Especialidad','Pais Residencia','Provincia','Domicilio','Codigo Postal','Email','Laboratorio'\r\n";
        include "dbConn.php"; # me da el obj $MYSQLI
        $query = "SELECT I.ID, I.Apellido,I.Nombre, T.Nombre as TipoDoc,I.NumeroDoc,P1.Nombre as PaisNac,PR.Nombre as Profesion,I.Especialidad,P2.Nombre as PaisRes,I.Provincia,I.Domicilio,I.CodigoPostal,I.Email, L.Nombre as Laboratorio ";
        $query.= "from Inscriptos I, Paises P1 , Paises P2, Profesion PR, TipoDoc T, Laboratorios L ";
        $query.= "where P1.id = I.PaisNac AND P2.id = I.paisRes AND I.Profesion = PR.ID and I.TipoDoc = T.ID and L.ID = I.Laboratorio";
        if ($result = $MYSQLI->query($query)) {
            while (($res = $result->fetch_row()) != NULL) {
                foreach ($res as $field) {
                    echo "'" . $field . "',";
                }
                echo "\r\n";
            }
            $MYSQLI->close();
            return json_encode($json);
        } else {
            die();
        }
    }

}
