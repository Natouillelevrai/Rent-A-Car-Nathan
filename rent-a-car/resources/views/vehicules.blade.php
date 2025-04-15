<x-layouts.app>
    <div class='w-full my-15'>
        <div class='w-full py-3 flex flex-row justify-between flex-wrap'>
            @foreach ($cars as $car)
                <div class='w-30/100 h-45/100 my-3 bg-[#FAFAFA] rounded-3xl'>
                    <img src='{{ $car->img }}' class='w-full h-70 rounded-t-3xl'>

                    <div class='w-full h-70 p-5'>
                        <div class='w-full h-full flex flex-col justify-between items-center'>
                            <div class='w-full h-20/100 flex flex-col'>
                                <div class='w-full h-60/100 flex flex-row justify-between items-center'>
                                    <p class='text-[1.5em] font-semibold'>{{ $car->brand }}</p>
                                    <p class='text-[1.5em] text-[#5937E0] font-semibold'>${{ $car->price_per_day }}</p>
                                </div>

                                <div class='w-full h-40/100 my-3 flex flex-row justify-between items-center'>
                                    <p class='text-gray-500 font-semibold'>{{ $car->model }}</p>
                                    <p class='text-gray-500 font-semibold'>per day</p>
                                </div>
                            </div>

                            <div class='w-full h-40/100 flex flex-row justify-between items-center text-[1.1em]'>
                                <p><i class="fa-solid fa-car pr-1"></i> {{ ucfirst(strtolower($car->transmission)) }}</p>
                                <p><i class="fa-solid fa-gas-pump pr-1"></i> {{ ucfirst(strtolower($car->fuel_type)) }}</p>
                                @if ($car->air_conditioning)
                                    <p><i class="fa-solid fa-snowflake pr-1"></i> Air Conditioner</p>
                                @endif
                            </div>

                            <a class='w-full h-20/100 bg-[#5937E0] text-white flex justify-center items-center rounded-xl'>View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>