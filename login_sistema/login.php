<?php
session_start();
require 'db.php';

// Mostrar errores para depurar
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mensaje = "";

if (isset($_POST['login'])) {
    $correo   = trim($_POST['correo']);
    $password = trim($_POST['password']);

    if ($correo == "" || $password == "") {
        $mensaje = "Completa ambos campos.";
    } else {
        $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $nombre, $hash);
            $stmt->fetch();

            if (password_verify($password, $hash)) {
                // Crear sesión
                $_SESSION['usuario_id'] = $id;
                $_SESSION['usuario_nombre'] = $nombre;

                header("Location: dashboard.php");
                exit;
            } else {
                $mensaje = "Contraseña incorrecta.";
            }
        } else {
            $mensaje = "No existe un usuario con ese correo.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #d9e4f5, #f3f6fb);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 360px;
            background: #fff;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        h2 {
            margin: 0 0 20px;
            text-align: center;
            font-weight: 700;
            font-size: 26px;
            color: #222;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            margin-bottom: 14px;
            border-radius: 10px;
            border: 1px solid #cfd4dd;
            font-size: 14px;
            transition: 0.2s;
        }

        input:focus {
            border-color: #3A57E8;
            box-shadow: 0 0 0 3px rgba(58,87,232,0.15);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #3A57E8;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.25s;
            margin-top: 5px;
        }

        button:hover {
            background: #2E47C9;
        }

        .mensaje {
            text-align: center;
            color: #D9534F;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .link {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .link a {
            color: #3A57E8;
            text-decoration: none;
            font-weight: 600;
        }

        .link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <div class="card">
        <h2>Iniciar sesión</h2>

        <?php if ($mensaje != "") echo "<p class='mensaje'>$mensaje</p>"; ?>

        <form action="login.php" method="POST">
            <label>Correo</label>
            <input type="email" name="correo" required>

            <label>Contraseña</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Ingresar</button>
        </form>

        <div class="link">
            ¿No tienes cuenta? <a href="register.php">Crear cuenta</a>
        </div>
    </div>

</body>
</html>
