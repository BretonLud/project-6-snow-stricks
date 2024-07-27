window.addEventListener('turbo:render', () => {
    getArrowUp()
    getArrowDown()
})

function goToSectionTricks()
{
    const tricksSection = document.querySelector('.tricks');

    tricksSection.scrollIntoView({
        behavior: 'smooth',
    });
}

function getArrowDown()
{
    if (!document.querySelector('.bi-arrow-down')) {
        return;
    }

    const arrowDown = document.querySelector('.bi-arrow-down');
    arrowDown.addEventListener('click', goToSectionTricks)
}

function getArrowUp()
{
    if (!document.querySelector('.bi-arrow-up')) {
        return;
    }

    const arrowUp = document.querySelector('.bi-arrow-up');
    arrowUp.addEventListener('click', goToSectionTricks)
}

getArrowDown()
getArrowUp()