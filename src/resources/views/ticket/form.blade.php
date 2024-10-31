<x-guest-layout>
    <div class="min-h-screen flex justify-center">
        <div class="px-3 py-6 w-full max-w-3xl">
            <div class="w-full text-left">
                <h2 class="p-2 text-2xl font-semibold text-gray-800">
                    チケットの選択
                </h2>

                <livewire:ticket-form :user="$user">
            </div>
        </div>
    </div>
</x-guest-layout>
