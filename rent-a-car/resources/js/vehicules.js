const carsListDOM = document.querySelector('#carsList');
const vehiculesBtns = document.querySelector('#types').children;
const energyBtns = document.querySelector('#energy').children;
const transmissionsBtns = document.querySelector('#transmissions').children;

let selectedType = vehiculesBtns[0]?.value || '';
let selectedEnergy = energyBtns[0]?.value || '';
let selectedTransmission = transmissionsBtns[0]?.value || '';

vehiculesBtns[0]?.classList.add('bg-indigo-600', 'text-white');
energyBtns[0]?.classList.add('bg-indigo-600', 'text-white');
transmissionsBtns[0]?.classList.add('bg-indigo-600', 'text-white');

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

async function fetchCars(limit = "", type = "", fuel_type = "", transmission = "") {
    const response = await fetch('/api/cars?limit=' + limit + '&type=' + type + '&fuel_type=' + fuel_type + '&transmission=' + transmission);
    const cars = await response.json();
    return cars;
}

function displayCars(cars) {
    carsListDOM.innerHTML = '';

    cars.forEach(car => {
        const card = document.createElement('div');
        card.className = 'w-30/100 h-45/100 my-3 bg-[#FAFAFA] rounded-3xl';

        const img = document.createElement('img');
        img.src = car.img;
        img.className = 'w-full h-70 rounded-t-3xl';
        card.appendChild(img);

        const content = document.createElement('div');
        content.className = 'w-full h-70 p-5';

        const contentInner = document.createElement('div');
        contentInner.className = 'w-full h-full flex flex-col justify-between items-center';

        const brandPriceContainer = document.createElement('div');
        brandPriceContainer.className = 'w-full h-20/100 flex flex-col';

        const brandPriceRow = document.createElement('div');
        brandPriceRow.className = 'w-full h-60/100 flex flex-row justify-between items-center';

        const brand = document.createElement('p');
        brand.className = 'text-[1.5em] font-semibold';
        brand.textContent = car.brand;

        const price = document.createElement('p');
        price.className = 'text-[1.5em] text-[#5937E0] font-semibold';
        price.textContent = `$${car.price_per_day}`;

        brandPriceRow.appendChild(brand);
        brandPriceRow.appendChild(price);
        brandPriceContainer.appendChild(brandPriceRow);

        const modelRow = document.createElement('div');
        modelRow.className = 'w-full h-40/100 my-3 flex flex-row justify-between items-center';

        const model = document.createElement('p');
        model.className = 'text-gray-500 font-semibold';
        model.textContent = car.model;

        const perDay = document.createElement('p');
        perDay.className = 'text-gray-500 font-semibold';
        perDay.textContent = 'per day';

        modelRow.appendChild(model);
        modelRow.appendChild(perDay);
        brandPriceContainer.appendChild(modelRow);

        contentInner.appendChild(brandPriceContainer);

        const featuresRow = document.createElement('div');
        featuresRow.className = 'w-full h-40/100 flex flex-row justify-between items-center text-[1.1em]';

        const transmission = document.createElement('p');
        transmission.innerHTML = `<i class="fa-solid fa-car pr-1"></i> ${capitalize(car.transmission)}`;

        const fuelType = document.createElement('p');
        fuelType.innerHTML = `<i class="fa-solid fa-gas-pump pr-1"></i> ${capitalize(car.fuel_type)}`;

        featuresRow.appendChild(transmission);
        featuresRow.appendChild(fuelType);

        if (car.air_conditioning) {
            const airConditioning = document.createElement('p');
            airConditioning.innerHTML = `<i class="fa-solid fa-snowflake pr-1"></i> Air Conditioner`;
            featuresRow.appendChild(airConditioning);
        }

        contentInner.appendChild(featuresRow);

        const viewDetails = document.createElement('a');
        viewDetails.className = 'w-full h-20/100 bg-[#5937E0] text-white flex justify-center items-center rounded-xl';
        viewDetails.textContent = 'View Details';
        viewDetails.href = `/vehicule/${car.id}`;

        contentInner.appendChild(viewDetails);
        content.appendChild(contentInner);
        card.appendChild(content);

        carsListDOM.appendChild(card);
    });
}

async function updateCars() {
    const cars = await fetchCars(-1, selectedType, selectedEnergy, selectedTransmission);
    displayCars(cars);
}

for (let i = 0; i < vehiculesBtns.length; i++) {
    vehiculesBtns[i].addEventListener('click', function () {
        for (let j = 0; j < vehiculesBtns.length; j++) {
            vehiculesBtns[j].classList.remove('bg-indigo-600', 'text-white');
        }
        vehiculesBtns[i].classList.add('bg-indigo-600', 'text-white');
        selectedType = vehiculesBtns[i].value;
        updateCars();
    });
}

for (let i = 0; i < energyBtns.length; i++) {
    energyBtns[i].addEventListener('click', function () {
        for (let j = 0; j < energyBtns.length; j++) {
            energyBtns[j].classList.remove('bg-indigo-600', 'text-white');
        }
        energyBtns[i].classList.add('bg-indigo-600', 'text-white');
        selectedEnergy = energyBtns[i].value;
        updateCars();
    });
}

for (let i = 0; i < transmissionsBtns.length; i++) {
    transmissionsBtns[i].addEventListener('click', function () {
        for (let j = 0; j < transmissionsBtns.length; j++) {
            transmissionsBtns[j].classList.remove('bg-indigo-600', 'text-white');
        }
        transmissionsBtns[i].classList.add('bg-indigo-600', 'text-white');
        selectedTransmission = transmissionsBtns[i].value;
        updateCars();
    });
}

window.addEventListener('DOMContentLoaded', () => {
    updateCars();
});
