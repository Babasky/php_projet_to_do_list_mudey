<?php
// Initialisation des variables d'erreur
$titleError = "";
$descriptionError = "";
$isValid = true; // Variable pour vérifier si toutes les validations sont passées

// Ajouter une nouvelle tâche
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $title = htmlspecialchars(htmlspecialchars_decode($_POST['title']));
    $description = htmlspecialchars(htmlspecialchars_decode($_POST['description']));

    // Validation du titre
    if (empty($title)) {
        $titleError = "Le titre est requis.";
        $isValid = false;
    } elseif (!preg_match("/^[a-zA-Z0-9\s]+$/", $title)) {
        $titleError = "Le titre ne doit contenir que des lettres, chiffres et espaces.";
        $isValid = false;
    }

    // Validation de la description (ex : lettres, chiffres, ponctuations, longueur max 200 caractères)
    if (empty($description)) {
        $descriptionError = "La description est requise.";
        $isValid = false;
    } elseif (strlen($description) > 200) {
        $descriptionError = "La description ne doit pas dépasser 200 caractères.";
        $isValid = false;
    }

    // Si toutes les validations passent, on ajoute la tâche
    if ($isValid) {
        $file = fopen("tasks.txt", "a");
        fwrite($file, $title . " : " . $description . " : En cours\n");
        fclose($file);

        // Rediriger pour vider le formulaire après l'ajout
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}


// Changer le statut de la tâche
if (isset($_GET['status'])) {
    $tasks = file("tasks.txt");
    $updatedTasks = [];
    foreach ($tasks as $task) {
        $line = explode(" : ", trim($task));
        if ($line[0] == $_GET['status']) {
            $line[2] = ($line[2] == "En cours") ? "Terminé" : "En cours";
        }
        $updatedTasks[] = implode(" : ", $line) . "\n";
    }
    file_put_contents("tasks.txt", $updatedTasks);

    // Rediriger pour éviter la répétition de l'action
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Supprimer une tâche
if (isset($_GET['delete'])) {
    $tasks = file("tasks.txt");
    $updatedTasks = [];
    foreach ($tasks as $task) {
        $line = explode(" : ", trim($task));
        if ($line[0] != $_GET['delete']) {
            $updatedTasks[] = $task;
        }
    }
    file_put_contents("tasks.txt", $updatedTasks);

    // Rediriger après suppression pour éviter la répétition de l'action
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>


