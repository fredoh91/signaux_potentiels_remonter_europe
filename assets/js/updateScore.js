document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez tous les menus déroulants et le champ Score
    const dropdowns = document.querySelectorAll('select[id^="signal_potentiel_"]'); // Tous les selects commençant par "signal_potentiel_"
    const scoreField = document.getElementById('signal_potentiel_Score');

    // Fonction pour calculer le score total
    function calculateScore() {
        let totalScore = 0;

        // Parcourez tous les menus déroulants
        dropdowns.forEach(dropdown => {
            const selectedOption = dropdown.options[dropdown.selectedIndex];
            const score = parseInt(selectedOption.textContent.match(/\((-?\d+)\)/)?.[1] || 0); // Récupère les scores négatifs ou positifs
            console.log(score);
            totalScore += score;
        });

        // Mettez à jour le champ Score
        scoreField.value = totalScore;
    }

    // Ajoutez un écouteur d'événement pour chaque menu déroulant
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', calculateScore);
    });

    // Calcul initial au chargement de la page
    calculateScore();
});