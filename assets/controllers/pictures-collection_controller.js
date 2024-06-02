import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["collectionContainer"]

    static values = {
        index    : Number,
        prototype: String,
    }

    addCollectionElement(event)
    {
        const item = document.createElement('li');
        item.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);
        item.querySelector('#tricks_pictures_' + this.indexValue + '_index').value = this.indexValue;
        this.addTagFormDeleteLink(item);
        this.collectionContainerTarget.appendChild(item);
        this.indexValue++;
    }

   addTagFormDeleteLink(item) {
        const removeFormButton = document.createElement('button');
        removeFormButton.innerText = 'Delete this picture';

        item.append(removeFormButton);

        removeFormButton.addEventListener('click', (e) => {
            e.preventDefault();
            // remove the li for the tag form
            item.remove();
        });
    }

    connect() {
        this.collectionContainerTarget.querySelectorAll('li').forEach((item) => {
            this.addTagFormDeleteLink(item);
        });
    }
}