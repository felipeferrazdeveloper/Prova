<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 09/01/2018
 * Time: 13:33
 */

//carrega o cabeçalho e menus do site
include_once 'estrutura/Template.php';

//Class
require_once 'dao/avaliacaoDAO.php';

$template = new Template();

$template->header();
$template->sidebar();
$template->navbar();

$object = new avaliacaoDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nota1 = (isset($_POST["nota1"]) && $_POST["nota1"] != null) ? $_POST["nota1"] : "";
    $nota2 = (isset($_POST["nota2"]) && $_POST["nota2"] != null) ? $_POST["nota2"] : "";
    $notafinal = (isset($_POST["notafinal"]) && $_POST["notafinal"] != null) ? $_POST["notafinal"] : "";
    $curso = (isset($_POST["curso"]) && $_POST["curso"] != null) ? $_POST["curso"] : "";
    $aluno = (isset($_POST["aluno"]) && $_POST["aluno"] != null) ? $_POST["aluno"] : "";
    $turma = (isset($_POST["turma"]) && $_POST["turma"] != null) ? $_POST["turma"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nota1 = null;
    $nota2 = null;
    $notafinal = null;
    $curso = null;
    $aluno = null;
    $turma = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $avaliacao = new $avaliacao($id, '', '', '', '', '', '');
    $resultado = $object->atualizar($avaliacao);
    $nota1 = $resultado->getNota1();
    $nota2 = $resultado->getNota2();
    $notafinal = $resultado->getNotaFinal();
    $curso = $resultado->getCurso();
    $aluno = $resultado->getAluno();
    $turma = $resultado->getTurma();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nota1 != "") {
    $avaliacao = new $avaliacao($id, $nota1, $nota2, $notafinal, $curso, $aluno, $turma);
    $msg = $object->salvar($avaliacao);
    $id = null;
    $nota1 = null;
    $nota2 = null;
    $notafinal = null;
    $curso = null;
    $aluno = null;
    $turma = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $curso = new curso($id, '', '', '');
    $msg = $object->remover($curso);
    $id = null;
}

?>
<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Avaliacoes</h4>
                        <p class='category'>Lista de avaliacoes do sistema</p>
                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Nota 1:
                            <input type="text" size="40" name="nota1" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($nota1) && ($nota1 != null || $nota1 != "")) ? $nota1 : '';
                            ?>"/>
                            Nota 2:
                            <input type="text" size="20" name="nota2" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($nota2) && ($nota2 != null || $nota2 != "")) ? $nota2 : '';
                            ?>"/>

                            Nota Final:
                            <input type="text" size="20" name="notafinal" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($notafinal) && ($notafinal != null || $notafinal != "")) ? $notafinal : '';
                            ?>"/>
                            Aluno:
                            <select name="aluno"><?php
                                $query = "SELECT * FROM Aluno order by Nome;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->idAluno == $aluno) {
                                            echo "<option value='$rs->idAluno' selected>$rs->Nome</option>";
                                        } else {
                                            echo "<option value='$rs->idAluno'>$rs->Nome</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            Curso:
                            <select name="curso"><?php
                                $query = "SELECT * FROM Curso order by Nome;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->idCurso == $curso) {
                                            echo "<option value='$rs->idCurso' selected>$rs->Nome</option>";
                                        } else {
                                            echo "<option value='$rs->idCurso'>$rs->Nome</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            Turma:
                            <select name="curso"><?php
                                $query = "SELECT * FROM Turma order by Nome;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->idTurma == $turma) {
                                            echo "<option value='$rs->idTurma' selected>$rs->Nome</option>";
                                        } else {
                                            echo "<option value='$rs->idTurma'>$rs->Nome</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            <input type="submit" VALUE="Cadastrar"/>
                            <hr>
                        </form>
                        <?php
                        echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';
                        //chamada a paginação
                        $object->tabelapaginada();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
