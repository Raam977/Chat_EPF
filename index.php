<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Chat EPF</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Primeiro nome</label>
            <input type="text" name="fname" placeholder="Primeiro Nome" required>
          </div>
          <div class="field input">
            <label>Ultimo nome</label>
            <input type="text" name="lname" placeholder="Ultimo nome" required>
          </div>
        </div>
        <div class="field input">
          <label>Email</label>
          <input type="text" name="email" placeholder="Coloque aqui o seu email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Ooloque aqui a sua password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Selecionar a imagem</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continuar para o Chat">
        </div>
      </form>
      <div class="link">Já estás incrito? <a href="login.php">Inicia sessão </a></div>
    </section>
  </div>
  <div id="canto">
  <img src="logo_EPFbaixov2.png">
  </div>

  

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
