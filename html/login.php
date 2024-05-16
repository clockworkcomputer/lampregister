<?php
    // Incluir el archivo de conexión a la base de datos
    include 'db.php';

    // Inicializar variables de error
    $error = "";

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $dni = $_POST["dni"];
        $pass = $_POST["pass"];

        // Consultar la base de datos para obtener la contraseña correspondiente al DNI ingresado
        $query = "SELECT pass FROM cliente WHERE dni = '$dni'";
        $result = $con->query($query);

        if ($result->num_rows == 1) {
            // Si se encuentra el usuario, verificar la contraseña
            $row = $result->fetch_assoc();
            $pass_hash = $row["pass"];
            if (password_verify($pass, $pass_hash)) {
                // Contraseña válida, iniciar sesión (aquí puedes agregar tu lógica de sesión)
                // Por ejemplo, podrías redirigir al usuario a una página de bienvenida
                header("Location: bienvenida.php");
                exit();
            } else {
                // Contraseña incorrecta
                $error = "Contraseña incorrecta";
            }
        } else {
            // Usuario no encontrado
            $error = "Usuario no encontrado";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni" autocomplete="off" required><br><br>
        <label for="pass">Contraseña:</label>
        <input type="password" name="pass" id="pass" required><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
    <?php echo $error; ?>
</body>
</html>
