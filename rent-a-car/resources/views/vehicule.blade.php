<x-layouts.app>
    <div class='w-full h-svh flex flex-row justify-between'>
        <div class='w-1/2 h-full p-5'>
            <h1 class='text-4xl pb-4 font-bold' id='carTitle'></h1>
            <p class='text-[#5937E0] text-4xl flex items-center font-bold'>
                <span id='carPrice'></span>
                $
                <span class='text-base text-black font-light ml-2'>/ day</span>
            </p>

            <img class='h-40/100 my-5' src="" id='carImg'>

            <div class='w-full flex flex-row gap-3'>
                <img class='w-20/100 my-3' src="https://img.lovepik.com/free-png/20210926/lovepik-a-car-png-image_401434180_wh1200.png">
                <img class='w-20/100 my-3' src="https://img.lovepik.com/free-png/20210926/lovepik-a-car-png-image_401434180_wh1200.png">
                <img class='w-20/100 my-3' src="https://img.lovepik.com/free-png/20210926/lovepik-a-car-png-image_401434180_wh1200.png">
            </div>
        </div>

        <div class='w-1/2 h-full p-5 flex flex-col justify-between'>
            <h2 class='text-2xl pb-4'>Technical specification</h2>

            <div class='h-100 flex flex-row justify-between flex-wrap'>
                <div class='w-31/100 h-45/100 my-2 p-5 bg-[#FAFAFA] rounded-2xl'>
                    <i class="fa-solid fa-gears text-3xl py-3"></i>
                    <p class='font-semibold'>Gear box</p>
                    <p class='font-light' id='carGear'></p>
                </div>

                <div class='w-31/100 h-45/100 my-2 p-5 bg-[#FAFAFA] rounded-2xl'>
                    <i class="fa-solid fa-gas-pump text-3xl py-3"></i>
                    <p class='font-semibold'>Energy type</p>
                    <p class='font-light' id='carFuel'></p>
                </div>

                <div class='w-31/100 h-45/100 my-2 p-5 bg-[#FAFAFA] rounded-2xl'>
                    <i class="fa-solid fa-car text-3xl py-3"></i>
                    <p class='font-semibold'>Type</p>
                    <p class='font-light' id='carType'></p>
                </div>

                <div class='w-31/100 h-45/100 my-2 p-5 bg-[#FAFAFA] rounded-2xl'>
                    <i class="fa-solid fa-door-open text-3xl py-3"></i>
                    <p class='font-semibold'>Doors</p>
                    <p class='font-light' id='carDoor'></p>
                </div>

                <div class='w-31/100 h-45/100 my-2 p-5 bg-[#FAFAFA] rounded-2xl'>
                    <i class="fa-solid fa-wind text-3xl py-3"></i>
                    <p class='font-semibold'>Air conditionner</p>
                    <p class='font-light' id='carAir'></p>
                </div>

                <div class='w-31/100 h-45/100 my-2 p-5 bg-[#FAFAFA] rounded-2xl'>
                    <i class="fa-solid fa-person text-3xl py-3"></i>
                    <p class='font-semibold'>Seats</p>
                    <p class='font-light' id='carSeat'></p>
                </div>
            </div>

            <a id='rentBtn' href='#' class='w-40/100 h-6/100 text-white bg-[#5937E0] flex justify-center items-center rounded-xl'>Rent a car</a>

            <div class='h-30/100'>
                <h2>Car Equipment</h2>
                <div class='h-80/100 flex flex-col flex-wrap' id='carEquipement'></div>
            </div>

        </div>
    </div>

    <div class='w-full my-10'>
        <div class='w-full py-3 flex flex-row justify-between flex-wrap' id='carsList'></div>
    </div>

    <p class='hidden' id='carId'>{{ $id }}<p>
    @vite('resources/js/vehicule.js')
</x-layouts.app>
