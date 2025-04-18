<x-layouts.app>
    <h1 class='w-full text-center text-4xl font-semibold mt-15 mb-5'>Reservation</h1>

    <div class='w-full my-25 flex flex-row justify-between'>
        <div class='w-50/100 flex flex-col'>
            <h2 id='carTitle' class='text-4xl font-semibold'></h2>
            <p class='my-5 flex items-center font-light'><span class='text-4xl pr-2 text-[#5937E0] font-semibold'
                    id='carPrice'></span>/ day</p>
            <img class='h-100' id='carImg' src=''>

            <div class='w-full flex flex-row gap-3 my-5'>
                <img class='w-20/100 my-3' src="https://img.lovepik.com/free-png/20210926/lovepik-a-car-png-image_401434180_wh1200.png">
                <img class='w-20/100 my-3' src="https://img.lovepik.com/free-png/20210926/lovepik-a-car-png-image_401434180_wh1200.png">
                <img class='w-20/100 my-3' src="https://img.lovepik.com/free-png/20210926/lovepik-a-car-png-image_401434180_wh1200.png">
            </div>
        </div>

        <div class='w-30/100 flex flex-col px-20 flex justify-center items-center'>
            <form class='w-full h-60/100 p-10 flex flex-col justify-between' id='formDom'>
                <input type='date' class='w-full h-10 p-2 bg-gray-100 rounded-xl' id='startDate' value="2025-05-01" required>
                <input type='date' class='w-full h-10 p-2 bg-gray-100 rounded-xl' id='endDate' value="2025-05-05" required>

                <input type='email' class='w-full h-10 p-2 bg-gray-100 rounded-xl' id='email'  placeholder="Email" required>

                <input type='hidden' name='id' value='{{ $id }}'>

                <p>Total price : <span id='totalPrice'></span></p>
                <p class='hidden text-green-600' id='info'></p>

                <input type='submit' class='w-full h-12 text-white bg-[#5937E0] rounded-xl'>
            </form>
        </div>
    </div>

    <div class='w-full h-100 mb-25 p-20 text-white bg-[#5937E0] rounded-3xl flex flex-col justify-between bg-contain bg-no-repeat bg-right' 
    style="background-image: url('{{ asset('img/blur-car.png') }}');">
        <h2 class='text-5xl font-semibold'>Looking for a car ?</h2>
        <p class='text-4xl font-semibold'>+537 547-6401</p>
        <p>Amet cras hac orci lacus. Faucibus ipsum arcu lectus nibh sapien bibendum ullamcorper in...</p>
        <a class='bg-[#FF9E0C] p-3 w-10/100 rounded-xl flex flex-row justify-center items-center'>Book now</a>
    </div>

    <p id='carId' class='hidden'>{{ $id }}</p>
    @vite('resources/js/reservation.js')
</x-layouts.app>
