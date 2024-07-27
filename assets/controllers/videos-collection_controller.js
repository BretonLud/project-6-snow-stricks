import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["collectionContainer"]

    static values = {
        index    : Number,
        prototype: String,
    }

    addCollectionElement()
    {
        const item = document.createElement('li');
        item.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);
        item.classList.add('mb-3');
        this.itemTitle(item,this.indexValue);
        this.addTagFormDeleteLink(item);
        this.collectionContainerTarget.appendChild(item);
        this.indexValue++;
    }

    addTagFormDeleteLink(item) {
        const removeFormButton = document.createElement('button');
        removeFormButton.innerText = 'Delete this video';
        removeFormButton.classList.add('btn', 'btn-danger');
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

    itemTitle(item, indexValue)
    {
        const title = document.createElement('h5')
        const index = indexValue + 1
        title.innerHTML = "Video " + index + " :";
        title.classList.add('mb-3');

        item.insertAdjacentElement("afterbegin",title);
    }
}