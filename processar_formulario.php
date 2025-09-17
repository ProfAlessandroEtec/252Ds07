<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];


    include_once 'db/conexao.php'; // Inclui o arquivo de conexão com o banco de dados

  try {

      
      // Preparando o comando SQL para inserir os dados no banco
      $sql = "INSERT INTO cliente (nome, email,mensagem) VALUES (:nome, :email, :mensagem)";
      $stmt = $pdo->prepare($sql);

      // Bind dos parâmetros para evitar SQL Injection
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':mensagem', $mensagem);

      // Executando o comando SQL
      $stmt->execute();

      // Mensagem de sucesso
      //echo "Obrigado por entrar em contato, $nome! Sua mensagem foi enviada.";


       echo "<script>
      alert('Obrigado por entrar em contato, $nome! Sua mensagem foi enviada.');
      window.location.href = 'index.php';
    </script>"; 


  } catch (PDOException $e) {
      // Em caso de erro, exibe uma mensagem
    //  echo "Erro ao enviar a mensagem: " . $e->getMessage();

      
        echo "<script>
                alert('Erro ao enviar a mensagem: " . $e->getMessage() . "');
                window.location.href = 'index.php';
              </script>";
      
  }


    // Aqui você pode enviar um e-mail ou salvar os dados em um banco de dados
    //echo "Obrigado por entrar em contato, $nome! Sua mensagem foi enviada.";
}
?>