<?php
$messagesup = '';

require_once __DIR__ . '/../Model/modelRapport.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        // Récupérer les inputs
        $nom = $_POST['nom'] ?? '';
        $description = $_POST['description'] ?? '';
        $periode = $_POST['periode'] ?? '';
        $id_ut = $_SESSION['user']['id_ut'];

         $id_periode_map = [
            'mensuel' => 1,
            'trimestriel' => 2,
            'semestriel' => 3,
            'annuel' => 3
        ];
        
        $id_periode = $id_periode_map[$periode] ?? null;
        
        
        // Validation
        if (empty($nom) || empty($periode)) {
            $messagesup = "Veuillez remplir tous les champs obligatoires.";
        } else {
            if (existeRapportParNom($nom)) {
                $messagesup = "Un rapport avec ce nom existe déjà. Veuillez choisir un autre nom.";
            } else {
                if (ajouterRapport($nom, $description, $id_periode, $id_ut)) {
                    $messagesup = "Rapport généré avec succès !";
                } else {
                    $messagesup = "Erreur lors de la génération du rapport.";
                }
        }
    }
}
$rapports = getRapports();
?>