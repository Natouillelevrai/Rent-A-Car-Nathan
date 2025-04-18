const carsListDOM = document.querySelector('#carsList');
const carsId = document.querySelector('#carId').textContent;

const carTitle = document.querySelector('#carTitle');
const carPrice = document.querySelector('#carPrice');
const carImg = document.querySelector('#carImg');
const carGear = document.querySelector('#carGear');
const carFuel = document.querySelector('#carFuel');
const carType = document.querySelector('#carType');
const carDoor = document.querySelector('#carDoor');
const carAir = document.querySelector('#carAir');
const carSeat = document.querySelector('#carSeat');
const carEquipement = document.querySelector('#carEquipement');

const rentBtn = document.querySelector('#rentBtn');

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

async function fetchCars(limit) {
    const response = await fetch('/api/cars?limit=' + limit);
    const cars = await response.json();

    return cars;
}

async function fetchCar() {
    const response = await fetch('/api/cars/' + carsId);
    const cars = await response.json();

    return cars;
}

function displayCars(cars) {
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

function displayCarDetails(car) {
    const equipement = car[0].equipements.split(", ").map(item => item.trim());

    console.log(equipement)

    carTitle.textContent = `${car[0].brand}`;
    carPrice.textContent = `${car[0].price_per_day}`;
    carImg.src = car[0].img;
    carGear.textContent = capitalize(car[0].transmission);
    carFuel.textContent = capitalize(car[0].fuel_type);
    carType.textContent = capitalize(car[0].type);
    carDoor.textContent = `${car[0].doors} doors`;
    carAir.textContent = car[0].air_conditioning ? 'Yes' : 'No';
    carSeat.textContent = `${car[0].seats} seats`;

    rentBtn.href = "/vehicule/" + carsId + "/reservation"
    
    equipement.forEach((item) => {
        const div = document.createElement('div');
        const round = document.createElement('div');
        const p = document.createElement('p');
        const icon = document.createElement('i');

        div.className = 'w-50/100 h-30/100 flex flex-row items-center';
        round.className = 'size-8 rounded-full bg-[#5937E0] text-white flex justify-center items-center';
        p.className = 'px-3';
        icon.className = 'fa-solid fa-check text-white w-full text-center';

        div.appendChild(round);
        round.appendChild(icon);
        div.appendChild(p);

        p.textContent = item;

        carEquipement.appendChild(div);
    });
}

(async () => {
    const cars = await fetchCars(6);
    displayCars(cars);
})();

(async () => {
    const cars = await fetchCar();
    displayCarDetails(cars);
})();