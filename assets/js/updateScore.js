document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez tous les menus déroulants de scoring et le champ Score
    const dropdowns = document.querySelectorAll('select[data-scoring-field="true"]');
    const scoreField = document.getElementById('signal_potentiel_Score');

    // Fonction pour calculer le score total
    function calculateScore() {
        let totalScore = 0;
        const nbChamps = dropdowns.length;
        let nbChampsRemplis = 0;
        // Parcourez tous les menus déroulants
        dropdowns.forEach(dropdown => {
            const selectedOption = dropdown.options[dropdown.selectedIndex];
            const match = selectedOption.textContent.match(/\((-?\d+)\)/);
            let score = 0;

            if (match) {
                score = parseInt(match[1]); // Récupère le score
                nbChampsRemplis++; // Incrémente si un score valide est trouvé
            }

            totalScore += score;
        });

        if (nbChampsRemplis === nbChamps) {
            // Mettez à jour le champ Score
            scoreField.value = totalScore;
        } else {
            scoreField.value = ''; // Vide le champ si tous les champs ne sont pas remplis
        }
    }

    // Ajoutez un écouteur d'événement pour chaque menu déroulant
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', calculateScore);
    });

    // Calcul initial au chargement de la page
    calculateScore();
});