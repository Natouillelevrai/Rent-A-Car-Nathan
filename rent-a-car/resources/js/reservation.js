const carsListDOM = document.querySelector('#carsList');
const carsId = document.querySelector('#carId').textContent;

const carTitle = document.querySelector('#carTitle');
const carPrice = document.querySelector('#carPrice');
const carImg = document.querySelector('#carImg');

const startDate = document.querySelector('#startDate');
const endDate = document.querySelector('#endDate');

const totalPrice = document.querySelector('#totalPrice');

const carInfos = await fetchCar();

async function fetchCar() {
    const response = await fetch('/api/cars/' + carsId);
    const cars = await response.json();

    return cars;
}

function displayCarDetails(car) {
    carTitle.textContent = `${car[0].brand}`;
    carPrice.textContent = `$${car[0].price_per_day}`;
    carImg.src = car[0].img;
}

function calculateDateDifference(startDateStr, endDateStr) {
    try {
        if (!startDateStr || !endDateStr) {
            throw new Error("Both start and end dates must be provided.");
        }

        const startDate = new Date(startDateStr);
        const endDate = new Date(endDateStr);

        if (isNaN(startDate) || isNaN(endDate)) {
            throw new Error("Invalid date format. Use the format YYYY-MM-DD.");
        }

        if (endDate < startDate) {
            throw new Error("End date must be after the start date.");
        }

        const diffMs = endDate - startDate;
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
        const diffHours = Math.floor((diffMs / (1000 * 60 * 60)) % 24);
        const diffMinutes = Math.floor((diffMs / (1000 * 60)) % 60);
        const diffSeconds = Math.floor((diffMs / 1000) % 60);

        return diffDays;
    }

    catch (error) {
        return `Error: ${error.message}`;
    }
}

function calculPrice(days, price) {
    totalPrice.textContent = days * price;
}

displayCarDetails(carInfos);
calculPrice(calculateDateDifference(startDate.value, endDate.value), carInfos[0].price_per_day);

endDate.addEventListener("change", () => {
    const days = calculateDateDifference(startDate.value, endDate.value);

    if (typeof days === 'number') {
        calculPrice(days, carInfos[0].price_per_day);
    } 
    
    else {
        totalPrice.textContent = days + "$";
    }
});