<div class="flex ">

    <div class="relative w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/lucenabg.jpg') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-green-900 via-transparent to-transparent bg-opacity-70"></div>
    </div>

    <div class="w-1/2 flex flex-col items-center justify-center bg-white p-10">

        <h1 class="text-6xl font-extrabold text-green-800 mb-6">Solid Waste Management</h1>


        <p class="text-xl text-gray-700 mb-8 text-center">Join us in creating a cleaner, greener, and more sustainable environment for our community.</p>

        <a href="{{ route('complaints') }}" class="bg-green-600 hover:bg-green-700 transition-colors text-white font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105">
            Complain Now!
        </a>
    </div>
</div>
