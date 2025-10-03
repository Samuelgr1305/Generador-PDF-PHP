<?php
$server = "localhost";
$user   = "root";
$pass   = "";  
$db     = "estudiantes";
$conexion = mysqli_connect($server, $user, $pass, $db);

$mensaje = "";

if (isset($_POST['registro'])) {
    $Nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $Tarjeta_Identidad     = mysqli_real_escape_string($conexion, $_POST['tarjeta']); 
    $clave  = mysqli_real_escape_string($conexion, $_POST['clave']);

    // Verificar si ya existe
    $consulta = "SELECT * FROM estudiantes WHERE Tarjeta_identidad = '$Tarjeta_Identidad' LIMIT 1";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $mensaje = "❌ El estudiante con tarjeta de identidad $Tarjeta_Identidad ya está registrado.";
    } else {
        // Insertar con nombres EXACTOS de columnas
        $insertar = "INSERT INTO estudiantes (Nombre, Tarjeta_identidad, clave) 
                     VALUES ('$Nombre', '$Tarjeta_Identidad', '$clave')";
        
        if (mysqli_query($conexion, $insertar)) {
            $mensaje = "✅ El estudiante $Nombre, con documento ($Tarjeta_Identidad) ha sido registrado.";
        } else {
            $mensaje = "❌ Error al registrar: " . mysqli_error($conexion);
        }
    }
}

echo $mensaje;
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .btn {
      padding: 10px 20px;
      background: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      margin-top: 20px;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
    }
    .modal-content {
      background: #fff;
      margin: 10% auto;
      padding: 20px;
      border-radius: 10px;
      width: 350px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }
    .close {
      float: right;
      font-size: 20px;
      cursor: pointer;
      color: red;
    }
    .mensaje {
      margin: 20px auto;
      padding: 10px;
      background: #c27472;
      border: 1px solid #eb0202;
      border-radius: 5px;
      color: #006400;
      width: fit-content;
    }
    label {
      font-weight: bold;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 6px;
      margin: 6px 0;
      border: 1px solid #1b6312;
      border-radius: 4px;
    }
    input[type="submit"] {
      background: #28a745;
      color: #fff;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #218838;
    }
  </style>
</head>
<body>
  <style>
    /* Login */
    .login-wrap{
      min-height:72vh;
      display:flex;
      align-items:center;
      justify-content:center;

      /* Fondo con tu imagen */
      background: url("https://colegiocomfenalcoibague.edu.co/wp-content/uploads/2024/07/fachada-ie-augustoe.webp") no-repeat center center;
      background-size: cover;
      position: relative; width: 100%; height: 100vh;
      border-radius:12px;
    }

    .login-card{
      width:100%;
      max-width:420px;
      padding:26px;

      /* Fondo semitransparente para que se lea el texto */
      background: rgba(128, 192, 112, 0.92);
      border-radius:12px;
    }

    label{display:block;margin-bottom:6px;font-size:14px;color:#333}
    input{width:100%;padding:8px;margin-bottom:12px;border:1px solid #af6565;border-radius:6px}
    button{padding:8px 12px;border:none;border-radius:6px;background:#399918;color:#fff;cursor:pointer}
    button:hover{background:#2d7814}
  </style>
</head>
<body>

  <section class="login-wrap">
    <div class="login-card">
      <h2>ㅤㅤㅤㅤㅤㅤBienvenido</h2>
      <button class="btn" id="openModal" align: center;>Registrar a un estudiante</button>
  </div>

  <?php if (!empty($mensaje)): ?>
    <div class="mensaje"><?php echo $mensaje; ?></div>
  <?php endif; ?>

  <!-- Modal -->
 <!-- Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <h3>Formulario de registro</h3>
    <form method="POST" action="">
      
      <label>Nombre:</label>
      <input type="text" name="nombre" required>

      <label>Tarjeta de Identidad:</label>
      <input type="text" name="tarjeta" required>

      <label>Contraseña:</label>
      <input type="password" name="clave" required>

      <!-- Botón con name="registro" para que PHP lo detecte -->
      <input type="submit" name="registro" value="Registrar">
    </form>
  </div>
</div>


  <script>
    const modal = document.getElementById("myModal");
    const btnOpen = document.getElementById("openModal");
    const btnClose = document.getElementById("closeModal");

    btnOpen.onclick = () => { modal.style.display = "block"; }
    btnClose.onclick = () => { modal.style.display = "none"; }
    window.onclick = (event) => {
      if (event.target == modal) modal.style.display = "none";
    }
  </script>
    </div>
  </section>

</body>
</html>


  <!-- Botón para abrir modal -->
  <div style="text-align:center;">
    <section class="Reemplazos-wrap">
      <div class="reemplazos-card">
        
      </div>

    </section>

</body>
</html>
