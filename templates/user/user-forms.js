document.addEventListener('DOMContentLoaded', function() {
    let userCount = 1;
    const addUserButton = document.getElementById('add-user');
    const usersContainer = document.getElementById('users-container');

    addUserButton.addEventListener('click', function() {
        if (userCount < 5) {
            // Clonez le formulaire ou créez-en un nouveau ici
            let newUserForm = document.createElement('div');
            newUserForm.innerHTML = `
                <input type="email" name="user[${userCount}][email]" placeholder="Email">
                <input type="password" name="user[${userCount}][password]" placeholder="Mot de passe">
                <input type="text" name="user[${userCount}][lastname]" placeholder="Nom">
                <input type="text" name="user[${userCount}][firstname]" placeholder="Prénom">
                <input type="tel" name="user[${userCount}][mobile]" placeholder="Téléphone">
            `;
            usersContainer.appendChild(newUserForm);
            userCount++;
        }
    });
});