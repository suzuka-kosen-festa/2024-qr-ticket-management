<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen">
        <div class="max-w-4xl mx-auto py-6 px-6 sm:px-12 lg:px-16 text-center">
            <div class="md:flex md:flex-row md:space-x-8 justify-center items-center">
                <!-- Image section -->
                <div class="flex justify-center mb-8 md:mb-0 md:w-1/2">
                    <img src="/images/ghost-house.png" alt="Ghost House" class="w-full max-w-sm h-auto rounded-lg shadow-md">
                </div>

                <!-- Text and Button section -->
                <div class="md:w-1/2">
                    <h2 class="text-left mb-4 text-2xl font-semibold text-gray-700">
                        鈴鹿高専 高専祭 お化け屋敷チケット
                    </h2>

                    <p class="text-lg lg:text-xl font-light text-gray-600 dark:text-gray-300 mb-6 md:mb-10 max-w-3xl mx-auto">
                        王様から王冠を取り戻すように指示されたあなたは、館を目指して森の中を進んでいく。数々の試練を乗り越え、王冠を取り戻すことができるのか､､､
                    </p>

                    <x-button.primary-link href="{{ route('ticket') }}" text="チケット"/>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
