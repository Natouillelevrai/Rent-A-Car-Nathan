const carsListDOM = document.querySelector('#carsList');
const carsId = document.querySelector('#carId').textContent;

const formDom = document.querySelector('#formDom');
const formInfos = document.querySelector('#info');

const carTitle = document.querySelector('#carTitle');
const carPrice = document.querySelector('#carPrice');
const carImg = document.querySelector('#carImg');

const startDate = document.querySelector('#startDate');
const endDate = document.querySelector('#endDate');

const totalPrice = document.querySelector('#totalPrice');

const carInfos = await fetchCar();

const today = new Date().toISOString().split('T')[0];
startDate.setAttribute('min', today);

startDate.addEventListener('change', () => {
    endDate.setAttribute('min', startDate.value);
});

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
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (startDate < today) {
            throw new Error("Start date cannot be before today.");
        }

        if (endDate <= startDate) {
            throw new Error("End date must be after start date.");
        }

        const diffMs = endDate - startDate;
        const diffDays = Math.ceil(diffMs / (1000 * 60 * 60 * 24));

        return diffDays;
    } 
    
    catch (error) {
        return `Error: ${error.message}`;
    }
}

function calculPrice(days, price) {
    return days * price;
}

totalPrice.textContent = calculPrice(calculateDateDifference(startDate.value, endDate.value), carInfos[0].price_per_day) + "$";

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

formDom.addEventListener('submit', async (e) => {
    e.preventDefault();

    const form = e.target;

    const data = {
        startDate: form.startDate.value,
        endDate: form.endDate.value,
        email: form.email.value,
        vehicleId: form.id.value,
        price: calculPrice(calculateDateDifference(startDate.value, endDate.value), carInfos[0].price_per_day)
    };

    const response = await fetch('/api/booking', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    });

    const text = await response.text();

    try {
        const response = JSON.parse(text);

        if(response.added == true) {
            formInfos.textContent = "Réservation ajoutée avec succès !";
            formInfos.classList.remove('hidden');

            console.log('Réservation ajoutée avec succès !');
        }
    }

    catch (err) {
        console.error('Réponse non JSON :', err);
    }

});