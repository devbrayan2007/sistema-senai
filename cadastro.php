<?php
require_once 'php/connection.php';

session_start();

// Exibir todos os erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Teste de conexão com o banco de dados
$conexao = Conexao::getConn();

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o botão de cadastrar foi pressionado
    if (isset($_POST['btn-cadastrar'])) {
        // Receber os dados do formulário
        $nome_medicamento = $_POST['medicamento'];
        $tipo_medicamento = $_POST['tipo-produto'];
        $preco_medicamento = $_POST['preco'];
        $fabricante_medicamento = $_POST['fabricante'];
        $data_chegada = $_POST['data-chegada'];
        $categoria_medicamento = $_POST['categoria'];
        $descricao_medicamento = $_POST['descricao'];
        $data_validade = $_POST['data-validade'];
        $unidades_medicamentos = $_POST['unidades'];

        // Exibir dados para depuração
echo "<h2 style='color: #333;'>Dados recebidos:</h2>";
echo "<table style='border-collapse: collapse; width: 100%; background-color: #f9f9f9;'>";
echo "<tr><th style='border: 1px solid #dddddd; padding: 8px; text-align: left; background-color: #4CAF50; color: white;'>Campo</th>
          <th style='border: 1px solid #dddddd; padding: 8px; text-align: left; background-color: #4CAF50; color: white;'>Valor</th></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Nome</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>$nome_medicamento</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Tipo</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>$tipo_medicamento</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Preço</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>R$ $preco_medicamento</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Fabricante</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>$fabricante_medicamento</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Data de Chegada</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>$data_chegada</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Categoria</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>$categoria_medicamento</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Descrição</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>$descricao_medicamento</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Data de Validade</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>$data_validade</td></tr>";
echo "<tr><td style='border: 1px solid #dddddd; padding: 8px;'>Unidades</td>
          <td style='border: 1px solid #dddddd; padding: 8px;'>$unidades_medicamentos</td></tr>";
echo "</table>";



        // Preparar e executar a query diretamente
        $sql = "INSERT INTO medicamentos (nome_medicamento, tipo, preco, descricao, data_validade, unidade, fabricante, data_chegada, categoria) 
                VALUES ('$nome_medicamento', '$tipo_medicamento', '$preco_medicamento', '$descricao_medicamento', '$data_validade', '$unidades_medicamentos', '$fabricante_medicamento', '$data_chegada', '$categoria_medicamento')";

        try {
            // Usar exec() diretamente para executar a query
            $resultado = $conexao->exec($sql);
            if ($resultado) {
                echo "$nome_medicamento cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar! Verifique os dados.";
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    } else {
        echo "O botão de cadastrar não foi acionado.";
    }
} else {
    echo "Método não é POST.";
}
