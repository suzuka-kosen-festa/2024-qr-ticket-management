<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href={{ route('admin.ticket.dashboard')}} class="bg-gray-600 px-4 py-2 rounded-md text-white font-semibold">
                ダッシュボードページへ
            </a>

            <div class="my-4">
                <livewire:ticket-scanner />
            </div>

        </div>
    </div>
</x-app-layout>
