<x-layouts.app>
    <div class='w-full h-200 px-6 md:px-16 py-10 md:py-20 rounded-3xl bg-[#5937E0] bg-[length:60%] bg-bottom bg-no-repeat flex flex-col lg:flex-row items-center justify-between tracking-wide'
        style="background-image: url('{{ asset('img/blur-car.png') }}');">

        <!-- Texte -->
        <div class='w-full lg:w-[45%] text-white font-sans flex flex-col gap-6 mb-10 lg:mb-0'>
            <h1 class='text-3xl sm:text-4xl md:text-5xl font-bold leading-tight'>Experience the road like never before
            </h1>
            <p class='text-base sm:text-lg w-full md:w-[80%]'>Rent a car in just a few taps. Fast, flexible, and
                affordable, your next ride is always ready, wherever and whenever you need it.</p>
            <a class='w-fit px-6 py-3 bg-[#FF9E0C] text-sm font-bold flex justify-center items-center rounded-lg'>View
                all cars</a>
        </div>

        <!-- Formulaire -->
        <form
            class='w-full h-70/100 lg:w-[30%] bg-white rounded-3xl px-6 py-8 shadow-md flex flex-col justify-between items-center'>
            <h2 class='text-xl md:text-2xl text-center font-semibold mb-4'>Book your car</h2>

            <div class='w-full h-70/100 px-5 flex flex-col justify-center items-center gap-2'>
                <select id="vehicle-type" name="vehicle_type" class="block w-full h-20/100 p-2 border-none rounded-md bg-[#FAFAFA]">
                    <option value="" selected>Vehicule type</option>
                </select>

                <select id="country" name="country" class="block w-full h-20/100 p-2 border-none rounded-md bg-[#FAFAFA]">
                    <option value="" selected>Energy Type</option>
                </select>

                <select id="country" name="country" class="block w-full h-20/100 p-2 border-none rounded-md bg-[#FAFAFA]">
                    <option value="" selected>Type of gear</option>
                </select>
            </div>

            <a class='w-90/100 h-12/100 bg-[#FF9E0C] text-white font-semibold flex justify-center items-center rounded-xl'>Book now</a>
        </form>

    </div>
</x-layouts.app>
