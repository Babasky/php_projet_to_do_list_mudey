
<div class="container">
        <h2 class="title">Liste des tâches</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Affichage des tâches
            if (file_exists("tasks.txt")) {
                $file = fopen("tasks.txt", "r");
                while (($line = fgets($file)) !== false) {
                    $line = trim($line);
                    $task = explode(" : ", $line);

                    // S'assurer que la ligne contient bien 3 éléments (titre, description, statut)
                
                        // Ajout d'une classe dynamique selon le statut
                    $statusClass = ($task[2] == "Terminé") ? "done" : "in-progress";

                    echo "<tr>";
                    echo "<td>" . $task[0] . "</td>";
                    echo "<td>" . $task[1] . "</td>";
                    // Ajout de la classe sur la colonne du statut
                    echo "<td class='$statusClass'>" . $task[2] . "</td>";
                    echo "<td class='status-actions'>
                            <a href='?status=" . $task[0] . "' class='btn-success'><i class='fa-solid fa-check'></i></a> 
                            <a href='?delete=" . $task[0] . "' class='btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette tâche ?\")'><i class='fa-solid fa-trash'></i></a>
                        </td>";
                    echo "</tr>";
                    
                }
                fclose($file);
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>