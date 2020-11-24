<?php 
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);

        Control::deletar('tb_admin.usuarios','id',$idExcluir);
        Control::redirect(PATH_DEFAULT.'gerenciar-usuarios');
    }

?>
<section>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">User:</th>
                <th scope="col">Nome:</th>
                <th scope="col">Cargo (R$)</th>
                <th scope="col">Admin</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(!isset($_POST['filtrar'])){
                    $usuarios = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
                    $usuarios->execute();
                    $usuarios = $usuarios->fetchAll();
                }
                foreach ($usuarios as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value['user']; ?></td>
                        <td><?php echo $value['nome']; ?></td>
                        <td><?php echo $value['cargo']; ?></td>
                        <td>
                            <a href="editar-usuario?id=<?php echo $value['id']; ?>">edit </a>
                            <a href="gerenciar-usuarios?excluir=<?php echo $value['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar este registro?')"> exc</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>