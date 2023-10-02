import { showToast, clearForm } from './utils.js';
import { buildListBooks } from './book.js';

const user_id = JSON.parse(localStorage.getItem('user')).id;

let global_lists;

document.addEventListener('DOMContentLoaded', () => {
    const createList = document.getElementById('createList');
    const createListBtn = document.getElementById('createListSubmit');

    buildUserLists();
    createList.addEventListener('click', () => {
        $('#createListModal').modal('show')
    }
    );
    createListBtn.addEventListener('click', (event) => {
        submitListForm(event);
    }
    );
});

/////////////
//FUNCTIONS//
////////////

const buildUserLists = async () => {
    await getAllLists();
    const menu = document.getElementById('menu');

    for (const list of global_lists) {
        const dropdown = document.createElement('div');
        dropdown.className = 'dropdown';

        const listWrapper = document.createElement('div');
        listWrapper.className = 'list-wrapper d-flex flex-row align-items-center';
        listWrapper.setAttribute('data-bs-toggle', 'dropdown');
        listWrapper.setAttribute('listId', list.id);
        listWrapper.setAttribute('style', 'margin-bottom: 5px');


        const roundWhiteDiv = document.createElement('div');
        roundWhiteDiv.className = 'd-flex round-white-div justify-content-center align-items-center';

        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('viewBox', '0 0 16 16');
        svg.setAttribute('width', '30');
        svg.setAttribute('height', '30');
        svg.setAttribute('style', 'color: white');

        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('d', 'M0 2.75C0 1.784.784 1 1.75 1H5c.55 0 1.07.26 1.4.7l.9 1.2a.25.25 0 0 0 .2.1h6.75c.966 0 1.75.784 1.75 1.75v8.5A1.75 1.75 0 0 1 14.25 15H1.75A1.75 1.75 0 0 1 0 13.25Zm1.75-.25a.25.25 0 0 0-.25.25v10.5c0 .138.112.25.25.25h12.5a.25.25 0 0 0 .25-.25v-8.5a.25.25 0 0 0-.25-.25H7.5c-.55 0-1.07-.26-1.4-.7l-.9-1.2a.25.25 0 0 0-.2-.1Z');

        svg.appendChild(path);
        roundWhiteDiv.appendChild(svg);
        listWrapper.appendChild(roundWhiteDiv);

        const span = document.createElement('span');
        span.style.marginLeft = '10px';
        span.style.fontSize = '16px';
        span.style.fontWeight = 'bold';
        span.textContent = list.name;

        listWrapper.appendChild(span);
        dropdown.appendChild(listWrapper);

        const dropdownMenu = document.createElement('ul');
        dropdownMenu.className = 'dropdown-menu dropdown-menu-dark';

        const editList = document.createElement('li');
        editList.classList.add('editList');


        const editLink = document.createElement('a');
        editLink.className = 'dropdown-item';
        editLink.textContent = 'Editar';
        editLink.setAttribute('listId', list.id);

        editList.appendChild(editLink);
        dropdownMenu.appendChild(editList);

        const deleteList = document.createElement('li');
        deleteList.classList.add('deleteList');

        const deleteLink = document.createElement('a');
        deleteLink.className = 'dropdown-item';
        deleteLink.textContent = 'Excluir';
        deleteLink.setAttribute('listId', list.id);


        deleteList.appendChild(deleteLink);
        dropdownMenu.appendChild(deleteList);

        dropdown.appendChild(dropdownMenu);
        menu.appendChild(dropdown);
    }

    addListEvent();
}

const removeListWrappers = () => {
    const listWrappers = document.querySelectorAll('.list-wrapper');
    listWrappers.forEach(wrapper => wrapper.remove());
}

const submitListForm = (event) => {
    event.preventDefault();
    event.target.checkValidity();
    const form = document.getElementById('listForm');

    const formData = {
        name: $("#listNameInput").val(),
        desc: $("#listDesc").val(),
        parent: $("#listParent").val() || null,
        owner_id: user_id,
    };

    if (!formData.parent) {
        delete formData.parent;
    }

    const formDataInstance = new FormData(form);

    formDataInstance.append('owner_id', user_id);
    formDataInstance.append('name', formData.name);
    formDataInstance.append('desc', formData.desc);


    if (validateForm(formData)) {
        $.ajax({
            type: 'post',
            url: '/tiempo_digital_laravel/public/list/create',
            data: formDataInstance,
            contentType: false,
            processData: false,
            success: (jsonResponse) => {
                if (jsonResponse.status === 'error') {
                    showToast('Algo deu errado ao tentar criar sua lista', 'error');
                } else {
                    removeListWrappers();
                    buildUserLists();
                    showToast('Lista criada com sucesso', 'success');
                    clearForm('listForm')
                    $('#createListModal').modal('hide')
                }
            },
            error: (xhr, status, error) => {
                // Handle the error here
                console.error(xhr.responseText); // Log the response text
                showToast('Erro na solicitação: ' + error, 'error');
            }
        });
    }
}

const getAllLists = async () => {
    try {
        const response = await $.ajax({
            url: '/tiempo_digital_laravel/public/lists',
            type: 'get',
            data: {
                user_id: user_id,
            },
            dataType: 'json',
        });

        global_lists = response.lists;
    } catch (error) {
        throw error;
    }
}

const deleteList = async (listId) => {
    try {
        // await $.ajax({
        //     url: '../../../server/list/list.php',
        //     type: 'post',
        //     data: {
        //         id: listId,
        //         function: 'delete',
        //     },
        //     dataType: 'json',
        // });

        removeListWrappers();
        buildUserLists();
        showToast('Lista deletada com sucesso', 'success');
    } catch (error) {
        console.error(error);
        throw error;
    }
}

const addListEvent = () => {
    const lists = document.querySelectorAll('.list-wrapper');

    lists.forEach(div => {
        div.addEventListener('dblclick', (event) => {
            const targetId = event.target.closest('[listId]').getAttribute('listId');
            setCurrentList(targetId);
        });
    });

    const edits = document.querySelectorAll('.editList');

    edits.forEach(element => {
        element.addEventListener('click', () => {
            // Do something when the element is clicked
        });
    });

    const deletes = document.querySelectorAll('.deleteList');

    deletes.forEach(element => {
        element.addEventListener('click', (event) => {
            const targetId = event.target.closest('[listId]').getAttribute('listId');
            deleteList(targetId);
        });
    });
}

const validateForm = (formData) => {
    let valid = true;

    const name = document.getElementById('listName');
    const nameErrorMessage = document.getElementById('nameErrorMessage');

    if (!formData.name) {
        name.classList.add('is-invalid');
        nameErrorMessage.innerHTML = 'Digite um nome para lista';
        valid = false;
    } else {
        name.classList.remove('is-invalid');
    }

    return valid;
}

const setCurrentList = (listId) => {
    const list = global_lists.find((list) => list.id === parseInt(listId));
    const listName = document.querySelector('#listName');
    const listDescription = document.querySelector('#ListDescription');
    localStorage.setItem('list', listId);

    listName.textContent = list.name;
    listDescription.textContent = list.description;
    const bookList = document.getElementById('bookList');
    bookList.innerHTML = '';


    buildListBooks();
};
