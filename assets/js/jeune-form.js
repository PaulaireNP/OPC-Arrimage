
export default function JeuneForm() {
// Script pour le formulaire Accompagnement

    document.addEventListener('DOMContentLoaded', function () {
        const accompagnementChoices = document.querySelectorAll('.accompagnement-choice input');
        const typeAccompagnementDiv = document.querySelector('.type-accompagnement');
        const typeAccompagnementChoices = document.querySelectorAll('.type-accompagnement input');

        function updateTypeAccompagnementDisplay() {
            const selectedValue = document.querySelector('.accompagnement-choice input:checked').value;
            if (selectedValue === '0') { // Ancien
                typeAccompagnementDiv.style.display = 'block';
            } else { // Nouveau
                typeAccompagnementDiv.style.display = 'none';
                typeAccompagnementChoices.forEach(choice => {
                    choice.checked = false;
                    choice.required = false; // Rend le champ non requis
                });
            }
        }

        accompagnementChoices.forEach(function (choice) {
            choice.addEventListener('change', updateTypeAccompagnementDisplay);
        });

        updateTypeAccompagnementDisplay(); // Initialiser l'affichage lors du chargement de la page
    });


// Script pour le formulaire Réseaux

    document.addEventListener('DOMContentLoaded', function () {
        const reseauxSelect = document.getElementById('jeune_reseaux');
        const reseauxPrecisionField = document.getElementById('jeune_reseauxPrecision');

        function togglePrecisionField() {
            if (reseauxSelect.value === 'autres') {
                reseauxPrecisionField.style.display = 'block';
            } else {
                reseauxPrecisionField.style.display = 'none';
                reseauxPrecisionField.value = ''; // Réinitialiser le champ de précision si "Autres" n'est pas sélectionné
            }
        }

        reseauxSelect.addEventListener('change', togglePrecisionField);
        togglePrecisionField(); // Pour définir l'état initial
    });

// Script pour le formulaire Secteur, Référent et Co-référent


// Script pour le formulaire Rencontre

    document.addEventListener('DOMContentLoaded', function () {
        const rencontreChoices = document.querySelectorAll('.rencontre-choice input'); // Utilisation de la classe du formulaire
        const rencontrePrecisionField = document.querySelector('.rencontre-precision'); // Classe déjà correcte

        function isSpecialOptionSelected() {
// Modifier '5' et '0' en fonction des valeurs pour 'Partenaire (à préciser)' et 'Autres (à préciser)'
            return Array.from(rencontreChoices).some(choice =>
                (choice.checked && (choice.value === '5' || choice.value === '0')));
        }

        rencontrePrecisionField.style.display = 'none'; // Cache le champ

        rencontreChoices.forEach(function (choice) {
            choice.addEventListener('change', function () {
                if (isSpecialOptionSelected()) {
                    rencontrePrecisionField.style.display = 'block';
                } else {
                    rencontrePrecisionField.style.display = 'none';
                    rencontrePrecisionField.value = ''; // Réinitialiser le champ de précision
                }
            });
        });
    });

// Script pour le formulaire Situation

    document.addEventListener('DOMContentLoaded', function () {
        const situationChoices = document.querySelectorAll('.situation-choice input');
        const situationPrecisionField = document.querySelector('.situation-precision');

        function updateSituationPrecisionDisplay() {
            const isSpecialOptionSelected = Array.from(situationChoices).some(choice =>
                ['6', '7', '9', '10', '11', '0'].includes(choice.value) && choice.checked);

            if (isSpecialOptionSelected) {
                situationPrecisionField.style.display = 'block';
            } else {
                situationPrecisionField.style.display = 'none';
                situationPrecisionField.value = ''; // Réinitialiser le champ de précision
            }
        }

        situationChoices.forEach(function (choice) {
            choice.addEventListener('change', updateSituationPrecisionDisplay);
        });

        updateSituationPrecisionDisplay(); // Initialiser l'affichage lors du chargement de la page
    });


// Script pour le formulaire Actions Collectives

    document.addEventListener('DOMContentLoaded', function () {
        const actionsCollectivesChoices = document.querySelectorAll('.actions-collectives-choice input'); // Utilisation de la classe du formulaire
        const actionsCollectivesPrecisionField = document.querySelector('.actions-collectives-precision'); // Classe déjà correcte

        function isSpecialOptionSelected() {
            return Array.from(actionsCollectivesChoices).some(choice =>
                (choice.checked && (choice.value === '0')));
        }

        actionsCollectivesPrecisionField.style.display = 'none'; // Cache le champ

        actionsCollectivesChoices.forEach(function (choice) {
            choice.addEventListener('change', function () {
                if (isSpecialOptionSelected()) {
                    actionsCollectivesPrecisionField.style.display = 'block';
                } else {
                    actionsCollectivesPrecisionField.style.display = 'none';
                    actionsCollectivesPrecisionField.value = ''; // Réinitialiser le champ de précision
                }
            });
        });
    });

// Script pour le formulaire Problématique

    document.addEventListener('DOMContentLoaded', function () {
        const problematiqueChoices = document.querySelectorAll('.problematique-choice input'); // Utilisation de la classe du formulaire
        const problematiquePrecisionField = document.querySelector('.problematique-precision'); // Classe déjà correcte

        function isSpecialOptionSelected() {
            return Array.from(problematiqueChoices).some(choice =>
                (choice.checked && (choice.value === '0')));
        }

        problematiquePrecisionField.style.display = 'none'; // Cache le champ

        problematiqueChoices.forEach(function (choice) {
            choice.addEventListener('change', function () {
                if (isSpecialOptionSelected()) {
                    problematiquePrecisionField.style.display = 'block';
                } else {
                    problematiquePrecisionField.style.display = 'none';
                    problematiquePrecisionField.value = ''; // Réinitialiser le champ de précision
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const secteurSelect = document.getElementById('secteur-select');
        const referentEducSelect = document.getElementById('referentEduc-select');
        const coreferentEducSelect = document.getElementById('coreferentEduc-select');

        secteurSelect.addEventListener('change', function () {
            const secteurId = this.value;

            fetch(`/secteur/users/${secteurId}`)
                .then(response => response.json())
                .then(data => {
                    updateSelectOptions(referentEducSelect, data);
                    updateSelectOptions(coreferentEducSelect, data);
                    console.log(data);
                })
                .catch(error => console.error('Erreur:', error));
        });

        function updateSelectOptions(select, users) {
            // Efface les options existantes
            select.innerHTML = '';
            // Ajoute une option vide
            select.add(new Option('Choisir un utilisateur', ''));

            // Ajoute les nouvelles options
            users.forEach(user => {
                // Concatène le prénom et le nom
                select.add(new Option(user.name, user.id));
            });
        }
    });
}
JeuneForm();