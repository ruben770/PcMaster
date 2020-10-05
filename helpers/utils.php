<?php


class Utils
{
    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location:' . base_url);
        } else {
            return true;
        }
    }
    public static function isUser()
    {
        if (!isset($_SESSION['identity'])) {
            header('Location:' . base_url);
        } else {
            return true;
        }
    }

    public static function showCategorias()
    {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function showStatus($status)
    {
        $value = 'Pendiente';
        if ($status == 'Confirmed') {
            $value = "Pendiente de Pago";
        } elseif ($status == 'preparation') {
            $value = "En Preparación";
        } elseif ($status == 'ready') {
            $value = "Envío en curso";
        } elseif ($status == 'sent') {
            $value = "Entregado";
        }
        return $value;
    }


    public static function validateUser()
    {
        $res = array();
        if (empty($_POST["nombre"])) {
            $nameErr = "escriba un nombre";
            return $nameErr;
        } else {
            $name = Utils::test_input($_POST["nombre"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Solo letras y espacios son permitidos en el campo: Nombre";
                return $nameErr;
            }
        }
        array_push($res, $name);

        //apellidos
        if (empty($_POST["apellidos"])) {
            $apellidoErr = "escriba sus apellidos";
            return $apellidoErr;
        } else {
            $apellido = Utils::test_input($_POST["apellidos"]);
            // check if apellido only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $apellido)) {
                $apellidoErr = "Solo letras y espacios son permitidos en el campo: Apellidos";
                return $apellidoErr;
            }
        }
        array_push($res, $apellido);

        //email
        if (empty($_POST["email"])) {
            $emailErr = "escriba un email";
            return $emailErr;
        } else {
            $email = Utils::test_input($_POST["email"]);
            // check if email only contains letters and whitespace
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "El formato de email introducido no es válido";
                return $emailErr;
            }
        }
        array_push($res, $email);

        //password
        if (empty($_POST["password"])) {
            $passwordErr = "escriba su contraseña";
            return $passwordErr;
        } else {
            $password = Utils::test_input($_POST["password"]);
            // check if password only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z0-9 ]*$/", $password)) {
                $passwordErr = "La contraseña solo debe tener letras y numeros.";
                return $passwordErr;
            }
        }
        array_push($res, $password);
        return $res;
    }

    public static function validateProduct()
    {
        $res = array();
        if (empty($_POST["categoria"])) {
            $categoriaErr = "seleccione una categoria";
            return $categoriaErr;
        } else {
            $categoria = Utils::test_input($_POST["categoria"]);
        }
        array_push($res, $categoria);

        //nom
        if (empty($_POST["nombre"])) {
            $nombreErr = "escriba el nombre";
            return $nombreErr;
        } else {
            $nombre = Utils::test_input($_POST["nombre"]);
            // check if nombre only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z0-9 ]*$/", $nombre)) {
                $nombreErr = "Solo letras y numeros son permitidos en el campo: nombre";
                return $nombreErr;
            }
        }
        array_push($res, $nombre);

        //desc
        if (empty($_POST["descripcion"])) {
            $descripcion = NULL;
        } else {
            $descripcion = Utils::test_input($_POST["descripcion"]);
            // check if descripcion only contains letters and whitespace
            // if (!preg_match("/^[a-zA-Z0-9 ]*$/", $descripcion)) {
            //     $descripcionErr = "Solo letras y numeros son permitidos en el campo: descripcion";
            //     return $descripcionErr;
            // }
        }
        array_push($res, $descripcion);

        //precio
        if (empty($_POST["precio"])) {
            $precioErr = "escriba el precio";
            return $precioErr;
        } else {
            $precio = Utils::test_input($_POST["precio"]);
            // check if precio only contains letters and whitespace
            if (!is_numeric($precio)) {
                $precioErr = "El precio debe ser un numero.";
                return $precioErr;
            }
        }
        array_push($res, $precio);

        //stock
        if (empty($_POST["stock"])) {
            $stockErr = "escriba el stock";
            return $stockErr;
        } else {
            $stock = Utils::test_input($_POST["stock"]);
            // check if stock only contains letters and whitespace
            if (!is_numeric($stock)) {
                $stockErr = "El stock debe ser un numero.";
                return $stockErr;
            }
        }
        array_push($res, $stock);

        //oferta
        if (empty($_POST["oferta"])) {
            $oferta = NULL;
        } else {
            $oferta = Utils::test_input($_POST["oferta"]);
            // check if oferta only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z0-9% ]*$/", $oferta)) {
                $ofertaErr = "Solo letras, numeros y el simbolo % son permitidos en el campo: oferta";
                return $ofertaErr;
            }
        }
        array_push($res, $oferta);

        //fecha
        if (empty($_POST["fecha"])) {
            $fechaErr = "escriba una fecha";
            return $fechaErr;
        } else {
            $fecha = Utils::test_input($_POST["fecha"]);
        }
        array_push($res, $fecha);

        //imagen
        if ($_FILES["imagen"]['size'] <= 0) {
            $filename = NULL;
        } else {
            // var_dump(isset($_FILES["imagen"]));
            // die();
            $file = $_FILES['imagen'];
            $filename = $file['name'];
            $mimetype = $file['type'];


            if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                if (!is_dir('uploads/images')) {
                    mkdir('uploads/images', 0777, true);
                }
                move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
            } else {
                $imagenErr = "El formato de imagen no es soportado.";
                return $imagenErr;
            }
        }
        array_push($res, $filename);
        return $res;
    }
    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        if (isset($_SESSION['carrito'])) {
            $stats['count'] = count($_SESSION['carrito']);
            foreach ($_SESSION['carrito'] as $index => $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }
        return $stats;
    }

    public static function validateOrder()
    {
        $res = array();
        //estado
        if (empty($_POST["estado"])) {
            $estadoErr = "escriba el estado";
            return $estadoErr;
        } else {
            $estado = Utils::test_input($_POST["estado"]);
            // var_dump($estado);
            // die();
            // check if estado only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $estado)) {
                $estadoErr = "Solo letras son permitidas en el campo: estado";
                return $estadoErr;
            }
        }
        array_push($res, $estado);

        //municipio
        if (empty($_POST["municipio"])) {
            $municipioErr = "escriba el municipio";
            return $municipioErr;
        } else {
            $municipio = Utils::test_input($_POST["municipio"]);
            // check if municipio only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $municipio)) {
                $municipioErr = "Solo letras son permitidas en el campo: municipio";
                return $municipioErr;
            }
        }
        array_push($res, $municipio);


        //direccion
        if (empty($_POST["direccion"])) {
            $direccion = NULL;
        } else {
            $direccion = Utils::test_input($_POST["direccion"]);
            // check if direccion only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z0-9#\- ]*$/", $direccion)) {
                $direccionErr = "Solo letras, numeros y el simbolos (# -) son permitidos en el campo: direccion";
                return $direccionErr;
            }
        }
        array_push($res, $direccion);

        return $res;
    }
}
