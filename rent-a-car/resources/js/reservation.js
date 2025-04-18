const carsListDOM = document.querySelector('#carsList');
const carsId = document.querySelector('#carId').textContent;

const carTitle = document.querySelector('#carTitle');
const carPrice = document.querySelector('#carPrice');
const carImg = document.querySelector('#carImg');

async function fetchCar() {
    const response = await fetch('/api/cars/' + carsId);
    const cars = await response.json();

    console.log(cars[0].img);

    return cars;
}

function displayCarDetails(car) {
    carTitle.textContent = `${car[0].brand}`;
    carPrice.textContent = `$${car[0].price_per_day}`;
    carImg.src = car[0].img;
}

(async () => {
    const cars = await fetchCar();
    displayCarDetails(cars);
})();