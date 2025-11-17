<?php
session_start();


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #d9e4f5, #f3f6fb);
            font-family: "Segoe UI", Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #fff;
            width: 420px;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            animation: fade 0.5s ease-in-out;
        }

        @keyframes fade {
            from {opacity: 0; transform: scale(0.98);}
            to {opacity: 1; transform: scale(1);}
        }

        h2 {
            margin-top: 0;
            font-size: 26px;
            font-weight: 700;
        }

        .info {
            background: #f1f4ff;
            padding: 12px;
            border-radius: 10px;
            margin: 14px 0;
            font-size: 15px;
        }

        .logout {
            display: inline-block;
            padding: 10px 14px;
            background: #D9534F;
            color: #fff;
            text-decoration: none;
            border-radius: 12px;
            margin-top: 10px;
            font-weight: 600;
        }

        .logout:hover {
            background: #b83f3c;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?> 👋</h2>

        <p>Bienvenido a tu panel. Esta página está protegida con sesión.</p>

        <div class="info">
            <strong>Tu ID:</strong> <?php echo $_SESSION['usuario_id']; ?><br>
            <strong>Tu nombre:</strong> <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>
        </div>

        <a class="logout" href="logout.php">Cerrar sesión</a>
    </div>

</body>
</html>

