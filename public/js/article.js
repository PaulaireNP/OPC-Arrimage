document.addEventListener('DOMContentLoaded', function () {
    let articles = []; // Variable pour stocker les données initiales
    let itemsPerPage = 10; // Nombre d'éléments affiché dans chaque page du tableau (modifiable)
    let currentPage = 1;
    let articlesFiltered =[];
    let sortOrders = {
        title: 'asc',
        creationDate: 'desc',
        updateDate: 'desc',
    };
    let lastSort = '';

    // Fonction pour afficher les données dans le tableau
    function displayData(data = articlesFiltered) {
        let tableBody = document.querySelector('.main-blog__table tbody'); // Le nom de class du tableau dans le twig (à adapter) et le tbody
        tableBody.innerHTML = '';

        // html à afficher dans le twig (à adapter)
        data.forEach(article => {
            let row = `<tr>
                        <td>${article.title}</td>
                        <td>${article.description}</td>
                        <td>${article.image}</td>
                        <td>${article.creationDate}</td>
                        <td>${article.updateDate}</td>
                        <td>${article.author}</td>
                        <td>${article.visible ? 'Oui' : 'Non'}</td>
                        <td>
                            <a href="/article/${article.id}">voir</a>
                            <a href="/article/${article.id}/edit">modifier</a>
                        </td>
                    </tr>`;
            tableBody.innerHTML += row;
        });
        // Mise à jour de la pagination après l'affichage des données
        updatePaginationButtons();
    }

    // Fonction de pagination
    function paginateData(data = articlesFiltered) {
        let start = (currentPage - 1) * itemsPerPage;
        let end = start + itemsPerPage;
        let paginatedData = data.slice(start, end);
        displayData(paginatedData);
    }

    // Gestion de la pagination
    function updatePaginationButtons(data = articlesFiltered) {
        let totalPages = Math.ceil(data.length / itemsPerPage);
        let paginationDiv = document.getElementById('pagination');
        paginationDiv.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            let button = document.createElement('button');
            button.innerText = i;
            button.addEventListener('click', function () {
                currentPage = i;
                paginateData();
            });
            paginationDiv.appendChild(button);
        }
    }

    // Route de la récupération des données de l'entité à afficher dans le tableau (à adapter)
    fetch('/article/data')
        .then(response => response.json())
        .then(data => {
            articles = data;
            articlesFiltered = articles;
            paginateData(); // Appel initial de la pagination après le chargement des données
        })
        .catch(error => console.error('Erreur lors de la récupération des données:', error));

    // Gestionnaire d'événement pour le changement de page
    document.getElementById('pagination').addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') {
            currentPage = parseInt(event.target.innerText);
            paginateData();
        }
    });

    // Fonction de filtrage, prend en paramètre l'id du champ de texte du twig correspondant et le la propriété de l'entité à filtrer
    function filterData(elementId, property) {
        let filterValue = document.getElementById(elementId).value.toLowerCase();
        articlesFiltered = articles.filter(article => article[property].toLowerCase().includes(filterValue));
        currentPage = 1; // Pour réinitialiser la page actuelle après le filtrage
        sortData(lastSort);
    }

    // Fonction de tri
    function sortData(sortBy) {
        const sortOrder = sortOrders[sortBy];
        articlesFiltered.sort((a, b) => {
            const aSortBy = (a[sortBy]).toString();
            const bSortBy = (b[sortBy]).toString();
            return sortOrder === 'asc' ? aSortBy.localeCompare(bSortBy) : bSortBy.localeCompare(aSortBy);
        });

        paginateData();
    }

    // Fonction qui supprime les autres champs qui commence par 'filter' à l'exception du 'currentField'
    function clearOtherFields(currentFieldId) {
        // Récupere les champs de texte et désactive leur EventListener
        let textFields = document.querySelectorAll('input[type="text"][id^="filter"]:not(#' + currentFieldId + ')');
        for (let i = 0; i < textFields.length; i++) {
            textFields[i].removeEventListener('input', filterHandler);
        }

        // Parcourez chaque champ de texte et effacez son contenu
        textFields.forEach(field => {
            field.value = '';
        });

        // Réactivez les gestionnaires d'événements une fois la suppression terminée
        for (let i = 0; i < textFields.length; i++) {
            textFields[i].addEventListener('input', filterHandler);

        }
    }



    // Gestionnaires d'événements pour les changements de filtres et de tri (à adapter et garder filter ou sort dans l'id des élément du twig)

    document.getElementById('filterTitle').addEventListener('input', function (){
        filterHandler('filterTitle', 'title');
    });
    document.getElementById('filterDescription').addEventListener('input', function (){
        filterHandler('filterDescription', 'description');
    });
    document.getElementById('filterAuthor').addEventListener('input', function (){
        filterHandler('filterAuthor', 'author');
    });

    function filterHandler(elementIDFieldId, property) {
        clearOtherFields(elementIDFieldId);
        filterData(elementIDFieldId, property);
    }

    const sorts = document.querySelectorAll(`[data-sort]`);
    sorts.forEach(function (element){
        element.addEventListener('click', function (){
            sortHandler(element.dataset.sort);
        })
    });

    function sortHandler(property) {
        sortOrders[property] = sortOrders[property] === 'asc' ? 'desc' : 'asc';
        sortData(property);
        lastSort = property;
    }

});
