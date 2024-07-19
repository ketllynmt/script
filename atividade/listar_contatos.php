<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banco_de_dados";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Seleciona todos os registros da tabela contacts
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Lista de Contatos</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Mensagem</th>
                <th>Atualizar</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["mensagem"] . "</td>
                <td>
                    <form action='atualiza_contato.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <textarea name='mensagem' rows='4' cols='50'>" . htmlspecialchars($row["mensagem"]) . "</textarea><br>
                        <input type='submit' value='Atualizar'>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn->close();
?>
