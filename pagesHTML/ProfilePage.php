<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    print_header();
?>

    <link rel='stylesheet' href = 'profile.css'>
    <div class="profile-container">
        <img src="user-avatar.jpg" alt="Foto de Perfil" class="profile-picture">
        <div class="profile-info">
            <?php

                // Exibir as informações na página
                echo "<h2>$username</h2>";
                echo "<p>Endereço de Faturação:</p>";
                echo "<p>Distrito: $distrito</p>";
                echo "<p>Concelho: $concelho</p>";
                echo "<p>Freguesia: $freguesia</p>";
                echo "<p>Rua: $rua</p>";
                echo "<p>Código Postal: $codigo_postal</p>";
            ?>
            <a href="ProfileManagement.html" class="edit-button">Editar Perfil</a>
        </div>
    </div>

    <?php print_footer(); ?>
</body>
</html>

