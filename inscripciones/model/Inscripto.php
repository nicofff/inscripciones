<?php

include "../lib/PHPMailer/PHPMailerAutoload.php";

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
        $this->categoria = $data["categoria"];
        if ($this->categoria == 1) {
            $this->laboratorio = $data["laboratorio"];
        } else {
            $this->laboratorio = 0;
        }

        $this->codigoInscripcion = substr(uniqid(), 5);

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
            } else {
                $this->email = $resObj->Email;
                return true;
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
        if (filter_var($this->categoria, FILTER_VALIDATE_INT) === false) {
            return false;
        }
        return true;
    }

    public function save() {
        include "dbConn.php"; # me da el obj $MYSQLI
        $query = "INSERT INTO Inscriptos (Apellido,Nombre,TipoDoc,NumeroDoc,PaisNac,Profesion,Especialidad,PaisRes,Provincia,Email,Categoria,Laboratorio,CodigoInscripcion) ";
        $query.= "VALUES ('" . $this->apellido . "','" . $this->nombre . "'," . $this->tipoDoc . "," . $this->numeroDoc . "," . $this->paisNac . "," . $this->profesion . ",'" . $this->especialidad;
        $query .= "'," . $this->paisRes . ",'" . $this->provincia . "','" . $this->email . "'," . $this->categoria . "," . $this->laboratorio . ",'" . $this->codigoInscripcion . "')";
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
        $query.= "Email = '" . $this->email . "' ,";
        $query.= "Categoria = " . $this->categoria . ",";
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
        $query = "SELECT I.ID, I.Apellido,I.Nombre, T.Nombre as TipoDoc,I.NumeroDoc,P1.Nombre as PaisNac,PR.Nombre as Profesion,I.Especialidad,P2.Nombre as PaisRes,I.Provincia,I.Email, C.Nombre as Categoria, L.Nombre as Laboratorio, I.CodigoInscripcion ";
        $query.= "from Inscriptos I, Paises P1 , Paises P2, Profesion PR, TipoDoc T, Laboratorios L, Categorias C ";
        $query.= "where P1.id = I.PaisNac AND P2.id = I.paisRes AND I.Profesion = PR.ID and I.TipoDoc = T.ID and L.ID = I.Laboratorio and C.ID = I.Categoria";
        if ($result = $MYSQLI->query($query)) {
            $json = array();
            while (($resObj = $result->fetch_object()) != NULL) {
                $json[] = $resObj;
            }
            $MYSQLI->close();
            return json_encode($json);
        } else {
            echo mysqli_error($MYSQLI);
        }
    }

    public static function get($id) {
        include "dbConn.php"; # me da el obj $MYSQLI
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return false;
        }
        $query = "SELECT I.ID,I.Apellido as apellido,I.Nombre as nombre,I.TipoDoc as tipoDoc,I.NumeroDoc as numeroDoc,I.PaisNac as paisNac,I.Profesion as profesion,I.Especialidad as especialidad,I.PaisRes as paisRes,I.Provincia as provincia, I.Categoria as categoria, I.Email as email, I.Laboratorio as laboratorio ";
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
    
    public static function getJoined($codigoInscripcion){
        include "dbConn.php"; # me da el obj $MYSQLI
        $query = "SELECT I.ID, I.Apellido,I.Nombre, T.Nombre as TipoDoc,I.NumeroDoc,P1.Nombre as PaisNac,PR.Nombre as Profesion,I.Especialidad,P2.Nombre as PaisRes,I.Provincia,I.Email, C.Nombre as Categoria, L.Nombre as Laboratorio, I.CodigoInscripcion ";
        $query.= "from Inscriptos I, Paises P1 , Paises P2, Profesion PR, TipoDoc T, Laboratorios L, Categorias C ";
        $query.= "where P1.id = I.PaisNac AND P2.id = I.paisRes AND I.Profesion = PR.ID and I.TipoDoc = T.ID and L.ID = I.Laboratorio and C.ID = I.Categoria AND I.CodigoInscripcion='".$codigoInscripcion."'";
        if ($result = $MYSQLI->query($query)) {
            $resObj =$result->fetch_object();
            $MYSQLI->close();
            return $resObj;
        } else {
            echo mysqli_error($MYSQLI);
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

    private function getEmailContent() {
        
        $joinedThis= $this->getJoined($this->codigoInscripcion);
        $redirectURL = $this->getRedirectURL();
        $header = '<img src="http://www.simposiocidemo2014.com.ar/wp-content/themes/enfold/inscripciones-master/inscripciones-master/frontend/img/header-mail.jpg" /> <br/> ';
        $content = '<h2>Ud se ha subscripto correctamente</h2><br/>';
        $content .= '<strong>Codigo de Registro:</strong><span>' . $this->codigoInscripcion . '</span><br/>';
        $content .= '<strong>Nombre:</strong><span>' . $this->nombre . '</span><br/>';
        $content .= '<strong>Apellido:</strong><span>' . $this->apellido . '</span><br/>';

        if ($this->esBecado()) {
            $content .= '<strong>Categoria de Inscripcion:</strong><span>' . $this->getCategoria() . ' por ' . $joinedThis->Laboratorio . '</span><br/>';
        } else {
            $content .= '<strong>Categoria de Inscripcion:</strong><span>' . $this->getCategoria() . '</span><br/>';
        }

        if ($this->esBecado()) {
            $footer = '<small>Importante: Esta inscripción como becado, será validada por CIDEMO ante el laboratorio/empresa becaria, de lo contrario, deberá abonar el arancel correspondiente: · Asistentes Argentinos: $ 600.- (pesos seiscientos); Asistentes Extranjeros: u$s 100.- (dólares cien)</small>';
        }
        if ($this->esNoBecado()) {
            $footer = '<small>Usted deberá abonar un arancel:<br/>· Asistentes Argentinos: $ 600.- (pesos seiscientos)<br/>· Asistentes Extranjeros: u$s 100.- (dólares cien)<br/>Antes del evento: efectivo. Sede SAGE Marcelo T. de Alvear 1381 9no piso CABA .Tel: 4816-9396/9391 <br/>Día del evento: efectivo. Acreditaciones</small>';
        }
        if ($this->esOtraCategoria()) {
            $footer = "";
        }


        $footer .= 'Para imprimir los datos de su subscripcion haga click <a href="' . $redirectURL . '?email=' . $this->email . '"> aquí.</a>';

        $emailContent = $header . $content . $footer;
        return mb_convert_encoding($emailContent, 'Windows-1252', "UTF-8");
    }

    public function sendConfirmationEmail() {
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.simposiocidemo2014.com.ar';  // Specify main and backup server
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@simposiocidemo2014.com.ar';                            // SMTP username
        $mail->Password = 'simposio2014123';                           // SMTP password
        $mail->From = 'info@simposiocidemo2014.com.ar';
        $mail->FromName = 'Simposio CIDEMO';
        $mail->addAddress($this->email);  // Add a recipient
        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Confirmacion Inscripcion';
        $mail->Body = $this->getEmailContent();

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        }
    }

    public static function getRedirectURL() {
        return "http://$_SERVER[HTTP_HOST]/inscripciones/frontend/UsuarioRegistrado.php";
    }

    private function esNoBecado() {
        return $this->categoria == 0;
    }

    private function esBecado() {
        return $this->categoria == 1;
    }

    private function esOtraCategoria() {
        return $this->categoria > 2;
    }

    private function getCategoria() {
        switch ($this->categoria) {
            case 0:
                return "No Becado";
            case 1:
                return "Becado";
            case 3:
                return "Autoridad";
            case 4:
                return "Coordinador";
            case 5:
                return "Panelista";
        }
    }

}
