
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="../css/paineladm.css">
</head>

<body>
<?php include 'sidebar.php'; ?>
<div class="container">
    <h2>Cadastro de Cliente</h2>
    <form action="salvar_cliente.php" method="POST">
        <label>Nome Completo:</label>
        <input type="text" name="nome_completo" required>

        <label>CPF:</label>
        <input type="text" name="cpf" required maxlength="14" placeholder="000.000.000-00">

        <label>RG:</label>
        <input type="text" name="rg">

        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento">

        <label>Telefone:</label>
        <input type="text" name="telefone" placeholder="(00) 00000-0000">

        <label>CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" placeholder="00000-000" onblur="buscarCEP()">

        <label>Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro">

        <label>Número:</label>
        <input type="text" name="numero">

        <label>Bairro:</label>
        <input type="text" id="bairro" name="bairro">

        <label>Cidade:</label>
        <input type="text" id="cidade" name="cidade">

        <label>UF:</label>
        <input type="text" id="uf" name="uf" maxlength="2">

        <label>Nome de Usuário:</label>
        <input type="text" name="nome_usuario" required>

        <button type="submit">Cadastrar</button>
    </form>
</div>

<script>
function buscarCEP() {
    let cep = document.getElementById('cep').value.replace(/\D/g, '');
    if (cep.length != 8) return;

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(response => response.json())
    .then(data => {
        if (!data.erro) {
            document.getElementById('logradouro').value = data.logradouro;
            document.getElementById('bairro').value = data.bairro;
            document.getElementById('cidade').value = data.localidade;
            document.getElementById('uf').value = data.uf;
        } else {
            alert('CEP não encontrado!');
        }
    })
    .catch(() => alert('Erro ao consultar o CEP!'));
}
</script>

<style>
.container { max-width: 600px; margin: 20px auto; }
form { display: flex; flex-direction: column; gap: 10px; }
input, button { padding: 8px; font-size: 1rem; }
button { background: #007BFF; color: white; border: none; cursor: pointer; }
button:hover { background: #0056b3; }
</style>

</body>