<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    print_header();
?>

<link rel="stylesheet" href="profile.css">

    <div class="edit-profile-container">
        <h2>Editar Perfil</h2>
        <div class="profile-picture-container">
            <img src="user-avatar.jpg" alt="Foto de Perfil" class="profile-picture">
            <button type="button">Adicionar Nova Imagem</button>
        </div>
        <form action="__.php" method="post"> <!-- Completar com o codigo php -->
            <ul>
                <li>
                    <label for="username">Nome de Usuário:</label>
                    <input type="text" id="username" name="username" value="Nome de Usuário Atual" required>
                </li>
                <li>
                    <label for="distrito">Distrito:</label>
                    <input type="text" id="distrito" name="distrito" value="Distrito Atual" required>
                </li>
                <li>
                    <label for="concelho">Concelho:</label>
                    <input type="text" id="concelho" name="concelho" value="Concelho Atual" required>
                </li>
                <li>
                    <label for="freguesia">Freguesia:</label>
                    <input type="text" id="freguesia" name="freguesia" value="Freguesia Atual" required>
                </li>
                <li>
                    <label for="rua">Rua:</label>
                    <input type="text" id="rua" name="rua" value="Rua Atual" required>
                </li>
                <li>
                    <label for="codigo_postal">Código Postal:</label>
                    <input type="text" id="codigo_postal" name="codigo_postal" value="Código Postal Atual" required>
                </li>
            </ul>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>

    

    <?php print_footer(); ?>
</body>
</html>


