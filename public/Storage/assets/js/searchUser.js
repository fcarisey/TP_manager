const form = document.forms.search;
const table = document.getElementById('search_table');
const tableDataCopy = table.children[1].innerHTML;

form.addEventListener('submit', (e) => {
    e.preventDefault();
});

form.addEventListener('keyup', (e) => {
    e.preventDefault();

    let value = e.target.value;

    value = value.trim();

    if (value.length > 2) {
        fetch('/utilisateur/search?s=' + value, {
            method: 'GET',
        })
            .then(response => response.json())
            .then(data => {
                // replace table data with new data
                table.children[1].innerText = '';

                data.forEach((item) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                            <td>${item.prenom}</td>
                            <td>${item.nom}</td>
                            <td class="text-secondary"><a href="#" class="text-reset"><b>${item.classe}</b></a></td>
                            <td>
                                <a href="#">Modifier</a>
                            </td>
                            <td>
                                <a href="#" class="text-red">Supprimer</a>
                            </td>
                        `;

                    table.children[1].insertAdjacentElement('beforeend', row);
                });
            })
            .catch(error => console.log(error));
    }else{
        table.children[1].innerHTML = tableDataCopy;
    }

});