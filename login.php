<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="comprueba_usuario.php" method="POST">
        <input type="text" name="user" placeholder="User" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>