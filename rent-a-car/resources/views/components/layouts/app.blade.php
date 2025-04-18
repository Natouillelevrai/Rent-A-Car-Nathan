<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body class='h-full work-sans px-5 lg:px-20'>
    <header class='my-8'>
        <nav class='w-full flex justify-between items-center'>
            <a href='/' class='text-xl flex items-center font-semibold'><i class="fa-solid fa-car pr-3 text-4xl"></i> Car Rental</a>

            <div class='w-30/100 flex justify-between items-center'>
                <a class='text-xl' href='/'>Accueil</a>
                <a class='text-xl' href='/vehicules'>Vehicules</a>
            </div>

            <div class='flex flex-row items-center'>
                <div class='size-10 text-white bg-[#5937E0] rounded-full flex justify-center items-center'>
                    <i class="fa-solid fa-phone"></i>
                </div>

                <div class='flex flex-col ml-2'>
                    <p>Need help?</p>
                    <p>+996 247-1680</p>
                </div>
            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class='w-full flex flex-col'>
        <div class='flex flex-row justify-between py-5'>
            <a href='/' class='text-xl flex items-center font-semibold'><i class="fa-solid fa-car pr-3 text-4xl"></i> Car Rental</a>

            <div class='flex flex-row items-center'>
                <div class='size-10 text-white bg-[#FF9E0C] rounded-full flex justify-center items-center'>
                    <i class="fa-solid fa-phone"></i>
                </div>

                <div class='flex flex-col ml-2'>
                    <p>Need help?</p>
                    <p>+996 247-1680</p>
                </div>
            </div>

            <div class='flex flex-row items-center'>
                <div class='size-10 text-white bg-[#FF9E0C] rounded-full flex justify-center items-center'>
                    <i class="fa-solid fa-phone"></i>
                </div>

                <div class='flex flex-col ml-2'>
                    <p>Need help?</p>
                    <p>+996 247-1680</p>
                </div>
            </div>

            <div class='flex flex-row items-center'>
                <div class='size-10 text-white bg-[#FF9E0C] rounded-full flex justify-center items-center'>
                    <i class="fa-solid fa-phone"></i>
                </div>

                <div class='flex flex-col ml-2'>
                    <p>Need help?</p>
                    <p>+996 247-1680</p>
                </div>
            </div>
        </div>

        <p class='text-center text-gray-500 py-10'>© Copyright Car Rental  2024. Design by Figma. guru</p>
    </footer>

    <script src="https://kit.fontawesome.com/6f902d2607.js" crossorigin="anonymous"></script>
</body>

</html>
