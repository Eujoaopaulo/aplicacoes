
<?php
// Inicializando o histórico
session_start();
if (!isset($_SESSION['historico'])) {
    $_SESSION['historico'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = floatval($_POST['num1']);
    $num2 = floatval($_POST['num2']);
    $operacao = $_POST['operacao'];
    $resultado = "";

    // Realizando a operação
    switch ($operacao) {
        case 'soma':
            $resultado = $num1 + $num2;
            break;
        case 'subtracao':
            $resultado = $num1 - $num2;
            break;
        case 'multiplicacao':
            $resultado = $num1 * $num2;
            break;
        case 'divisao':
            $resultado = ($num2 != 0) ? $num1 / $num2 : "Erro: Divisão por zero";
            break;
        default:
            $resultado = "Operação inválida";
    }

    // Armazenando a operação no histórico
    $historico_item = "$num1 $operacao $num2 = $resultado";
    array_push($_SESSION['historico'], $historico_item);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calculadora {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
        }
        input[type="number"], select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        h3 {
            color: #333;
            font-size: 18px;
        }
        .historico {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            max-height: 180px;
            overflow-y: auto;
            font-size: 14px;
        }
        .historico p {
            margin: 8px 0;
            color: #555;
        }
        .historico h3 {
            color: #444;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="calculadora">
        <h2>Calculadora do Joao</h2>

        <form method="post">
            <input type="number" name="num1" step="any" placeholder="Número 1" required>
            <select name="operacao">
                <option value="soma">Soma (+)</option>
                <option value="subtracao">Subtração (-)</option>
                <option value="multiplicacao">Multiplicação (×)</option>
                <option value="divisao">Divisão (÷)</option>
            </select>
            <input type="number" name="num2" step="any" placeholder="Número 2" required>
            <button type="submit">Calcular</button>
        </form>

        <?php if (isset($resultado)) { ?>
            <h3>Resultado: <?php echo $resultado; ?></h3>
        <?php } ?>

        <div class="historico">
            <h3>Histórico de Operações:</h3>
            <?php
                if (count($_SESSION['historico']) > 0) {
                    foreach ($_SESSION['historico'] as $item) {
                        echo "<p>$item</p>";
                    }
                } else {
                    echo "<p>Nenhuma operação realizada ainda.</p>";
                }
            ?>
        </div>
    </div>

</body>
</html>
