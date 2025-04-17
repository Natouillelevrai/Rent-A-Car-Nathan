<x-layouts.app>
    <div class='w-full flex flex-col justify-between items-center'>
        <h1 class='text-[2.5em] font-bold my-5'>Select a vehicle group</h1>

        <div class='flex flex-row justify-center my-5' id='types'>
            <button value='' class='w-45 mx-3 py-3 rounded-full text-white bg-[#F9F9F9] flex justify-center cursor-pointer'>All vehicules</button>

            @foreach ($vehicules_types as $type)
                <button value="{{ $type->name }}" class='w-45 mx-3 py-3 rounded-full text-black bg-[#F9F9F9] flex justify-center cursor-pointer'>{{ ucfirst($type->name) }}</button>
            @endforeach
        </div>

        <div class='flex flex-row justify-center my-5' id='energy'>
            <button value='' class='w-45 mx-3 py-3 rounded-full text-white bg-[#F9F9F9] flex justify-center cursor-pointer'>All Energy type</button>

            @foreach ($vehicules_fuels as $fuel)
                <button value="{{ $fuel }}" class='w-45 mx-3 py-3 rounded-full text-black bg-[#F9F9F9] flex justify-center cursor-pointer'>{{ ucfirst($fuel) }}</button>
            @endforeach
        </div>

        <div class='flex flex-row justify-center my-5' id='transmissions'>
            <button value='' class='w-45 mx-3 py-3 rounded-full text-white bg-[#F9F9F9] flex justify-center cursor-pointer'>All Type of gear</button>

            @foreach ($vehicules_transmissions as $transmission)
                <button value="{{ $transmission }}" class='w-45 mx-3 py-3 rounded-full text-black bg-[#F9F9F9] flex justify-center cursor-pointer'>{{ ucfirst($transmission) }}</button>
            @endforeach
        </div>
    </div>

    <div class='w-full my-10'>
        <div class='w-full py-3 flex flex-row justify-between flex-wrap' id='carsList'></div>
    </div>

    @vite('resources/js/vehicules.js')
</x-layouts.app>