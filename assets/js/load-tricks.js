window.addEventListener('turbo:render', () => {
    if (typeof tricksLength === 'undefined')
    {
        return;
    }

    if (tricksLength > 6)
    {
        getLoadMoreTricks()
    }
})

function handleClick()
{
    const offset = this.getAttribute('data-offset');
    const btn = this;
    fetch('/load-more-tricks/' + offset)
        .then(function (response) {
            return response.text();
        }).then(function(data){

        const tricksContent = document.querySelector('.tricks-content');
        tricksContent.insertAdjacentHTML('beforeend', data);

        const newOffset = Number(offset) + 6;

        if (newOffset > 15) {
            displayBlockArrowUp()
        }

        btn.setAttribute('data-offset', `${newOffset}`);

        if (newOffset > tricksLength) {
            btn.remove()
        }
    })
}

function getLoadMoreTricks()
{
    if (!document.querySelector('#loadMoreTricks'))
    {
        return;
    }

    const btn = document.querySelector('#loadMoreTricks');

    btn.addEventListener('click', handleClick)
}

function displayBlockArrowUp()
{
    const arrowUp = document.querySelector('.bi-arrow-up');
    arrowUp.style.display = 'block';
}

getLoadMoreTricks();