const NumbersComponent = function (element) {
    let numberElement = element.querySelector('.numbers_component_number');
    let button = element.querySelector('.numbers_component_button');
    let url = button.dataset.url;
    let ajax = new Ajax();

    const callback = (response) => {
        let {number} = JSON.parse(response);

        numberElement.innerHTML = number;
    }

    const onClick = () => {
        ajax.request(url, 'POST', callback);
    }

    button.addEventListener('click', onClick);
}

window.addEventListener('DOMContentLoaded', () => {
    //init numbers component if it exists on the page
    let numbersComponentElement = document.querySelector('.numbers_component');
    if (numbersComponentElement) {
        new NumbersComponent(numbersComponentElement);
    }
});