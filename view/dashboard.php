<?php
session_start();
require '../model/conexao.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fornecedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    // Início da verificação de login
    if(isset($_SESSION['login'])) {
    ?>
    <?php
    } else {
        // Se não estiver logado, redirecionar para a página de login
        header('Location: ../controller/login_controller.php');
        exit();
    }
    // Fim da verificação de login
    ?>
    <?php include('navbar.php'); ?>

    <div class="container mt-4">
        <?php include('mensagem.php'); ?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4> Lista de Fornecedores
                            <a href="fornecedor/fornecedor-create.php" class="btn btn-primary float-end">
                            <span class="bi-person-plus-fill"></span>&nbsp;Adicionar Fornecedor</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $sql = 'SELECT * FROM fornecedores WHERE ativo = TRUE';
                        $fornecedores = mysqli_query($conexao, $sql);
                        if (mysqli_num_rows($fornecedores) > 0) {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CNPJ</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Endereço</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($fornecedores as $fornecedor) {
                                    ?>
                                    <tr>
                                        <td><?=$fornecedor['nome_fornecedor']?></td>
                                        <td><?=$fornecedor['cnpj']?></td>
                                        <td><?=$fornecedor['telefone']?></td>
                                        <td><?=$fornecedor['email']?></td>
                                        <td><?=$fornecedor['endereco']?></td>
                                        <td>
                                            <a href="fornecedor/fornecedor-view.php?id=<?=$fornecedor['id_fornecedor']?>" class="btn btn-secondary btn-sm"><span class="bi-eye-fill"></span>&nbsp;Visualizar</a>
                                            <a href="fornecedor/fornecedor-edit.php?id=<?=$fornecedor['id_fornecedor']?>" class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Editar</a>
                                            <form action="../controller/fornecedor_controller.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_fornecedor" value="<?=$fornecedor['id_fornecedor']?>" class="btn btn-danger btn-sm">
                                                    <span class="bi-trash3-fill"></span>&nbsp;Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        } else {
                            echo '<h5>Nenhum fornecedor cadastrado</h5>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>