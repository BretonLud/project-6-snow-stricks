import {Modal} from "../vendor/bootstrap/bootstrap.index.js";

document.addEventListener('turbo:render', () => {
    attachEditButtonEvents();
});


function attachEditButtonEvents() {
    let editButtons = document.querySelectorAll(".edit-button:not([data-event-attached])");
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            let commentId = this.getAttribute('data-comment-id');
            let tricksSlug = this.getAttribute('data-tricks-slug');

            fetch(`/tricks/show/${tricksSlug}/comment/edit/${commentId}`)
                .then(response => response.text())
                .then(data => {
                    const content = document.createElement("div");
                    content.innerHTML = data;
                    const divModalBody = document.getElementById('editCommentModalBody');
                    // Placez le formulaire dans la modal
                    let modal = new Modal(document.getElementById('editCommentModal'));
                    modal.show();

                    divModalBody.innerHTML = content.innerHTML;
                    const form = divModalBody.querySelector("form");
                    // Affichez la modal

                    attachFormSubmitListener(form, modal, divModalBody);
                });
        });
        // Marquer le bouton comme ayant l'événement attaché
        button.setAttribute('data-event-attached', 'true');
    });
}

// Initial attachment
attachEditButtonEvents();

function attachFormSubmitListener(form, modal, divModalBody) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const content = form.querySelector('textarea');
        console.log(content.value.length)
        if (content.checkValidity() && content.value && content.value.length < 501) {
            form.submit();
        } else {
            fetch(form.action, {
                method: form.method,
                body: new FormData(form)
            })
                .then(response => response.text())
                .then(html => {
                    divModalBody.innerHTML = html;
                    const newForm = divModalBody.querySelector('form');
                    attachFormSubmitListener(newForm, modal, divModalBody);
                });
        }
    });
}