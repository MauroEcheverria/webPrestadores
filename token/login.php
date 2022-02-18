<?php
session_start();
echo $_SESSION["token"];
echo "<br>";
?>
<html>
<body>
<?php
if (isset($_SESSION["user"])) {
  echo "<p>Bienvenido de vuelta, " . $_SESSION["user"] . "!<br>";
  $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(32));
  echo '<a href="process.php?action=logout&csrf=' . $_SESSION["token"] . '">Logout</a></p>';
}
else {
  ?>
  <form action="process.php?action=login" method="post">
      <p>El nombre de usuario es: admin</p>
      <input type="text" name="user" size="20">
      <p>La contraseña es: test</p>
      <input type="password" name="pass" size="20">
      <input type="submit" value="Login">
  </form>
  <?php
}
?>
</body>
</html>