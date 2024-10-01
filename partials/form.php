<div class="container">
    <h2 class="title">Ajouter une tâche</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" placeholder="Titre" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
           
            <!-- Afficher l'erreur de validation du titre -->
            <?php if (!empty($titleError)) { ?>
                <span class="error" style="color: red;"><?php echo $titleError; ?></span>
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3" placeholder="Description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
            <!-- Afficher l'erreur de validation de la description -->
            <?php if (!empty($descriptionError)) { ?>
                <span class="error" style="color: red;"><?php echo $descriptionError; ?></span>
            <?php } ?>
        </div>
        <input type="submit" name="submit" value="Ajouter" class="btn">
    </form>
</div>
