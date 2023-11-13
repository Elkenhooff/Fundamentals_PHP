<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $nomeproduto = $_POST['nomeproduto'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $quantidade = (int)$quantidade;
    $preco = $_POST['preco'];
    $preco = (float)$preco;
    $totalitem = (($preco));
    #Gerar um random para definir um carrinho unico e exclusivo
    $numerocarrinho = rand();

    #Validação Cliente Logado
    if ($idusuario <= 0){
        echo ("<script>window.alert('Você precisa fazer login para adicionar o item ao carrinho')</script>");
        echo ("<script>window.location.href='loja.php';</script>");
    } else{
        #Verifica se existe um carrinho já aberto
        $sql = "SELECT COUNT(car_id) FROM carrinho INNER JOIN clientes ON fk_cli_id = cli_id WHERE cli_id = $idusuario AND car_finalizado = 'n'";

        $retorno = mysqli_query($link,$sql);
        #Se o carrinho não existe cria um novo carrinho
        while ($tbl = mysqli_fetch_array($retorno)){
            $cont = $tbl[0];
        }

        if ($cont == 0){
            $valor_venda = $quantidade * $preco;
            
            #Se o carrinho não existe gera um novo carrinho e insere na tabela
            $sql = "INSERT INTO carrinho(car_id, car_valorvenda, fk_cli_id, car_finalizado) VALUES ('$numerocarrinho', $valor_venda, $idusuario, 'n')";
            mysqli_query($link, $sql);

            #Insere o item no carrinho
            $sql2 = "INSERT INTO item_carinho(fk_car_id, fk_pro_id, car_item_quantidade) VALUES ($numerocarrinho, $id, $quantidade)";
            mysqli_query($link, $sql2);
            $_SESSION['carrinhoid'] = $numerocarrinho;
            echo ("<script>window.alert('Produto Adicionado ao Carrinho $numerocarrinho');</script>");
            echo ("<script>window.location.href='loja.php';</script>");
        }
        else{
            #Se carrinho existe, consulta o número do carrinho para adicionar mais itens
            $sql = "SELECT car_id FROM carrinho WHERE fk_cli_id = '$idusuario' AND car_finalizado = 'n'";
            $retorno = mysqli_query($link, $sql);

            while ($tbl = mysqli_fetch_array($retorno)){
                $numerocarrinho = $tbl[0];
                $_SESSION['carrinhoid'] = $numerocarrinho;

                
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
</head>
<body>
    <div class="formulario">
        <form class="visualizaproduto" action="verproduto.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" readonly>
            <label>Nome</label>
            <input type="text" name="nomeproduto" id="nome" value="<?= $nomeproduto ?>" readonly>
            <label>Descrição</label>
            <textarea name="descricao" readonly><?= $descricao?></textarea>
            <label>Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" min="0" value="1">
            <label>Preço</label>
            <input type="number" name="preco" id="preco" step="0.01" value="R$ <?= $preco ?>" readonly>
            <button id="btn">Adicionar ao Carrinho</button>
        </form>
    </div>
    <div class="favorito">
        <a href="favoritar.php?id=<?=$id?>">
        <img src="<?php echo ($coracao); ?>" width="50" height="50">
        </a>
        <h2>Imagem Atual</h2>
        <td><img name="imagem_atual" class="imagem_atual" src="data:imagem/jpeg;base64, <?= $imagem_atual ?>"></td>
    </div>
</body>
</html>