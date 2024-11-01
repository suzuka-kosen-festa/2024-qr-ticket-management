<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href={{ route('ticket.scan')}} class="bg-gray-600 px-4 py-2 rounded-md text-white font-semibold">
                QRのスキャンのページ
            </a>

            @foreach ($ticketList as $date => $tickets)
                <div class="my-6">
                    <h3 class="text-xl font-semibold ml-2 mb-2 text-gray-800">
                        {{ \Carbon\Carbon::parse($date)->format('m月d日') }} の整理券
                    </h3>
                    <div class="space-y-2">
                        <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                            @foreach ($tickets as $ticket)
                                <li class="w-full border-b border-gray-200 rounded-t-lg">
                                    <div class="flex items-center justify-between px-3">
                                        <div class="flex items-center space-x-2">
                                            <span class="w-full py-3 ms-2 text-sm font-medium {{ $ticket['balance'] <= 5 ? 'text-red-500' : 'text-gray-900' }}">
                                                {{ $ticket['title'] }} (残り: {{ $ticket['balance'] }} グループ)
                                            </span>
                                        </div>



                                        <a href={{ route('admin.ticket.edit', ['id' => $ticket['id'] ])}} class="bg-gray-700 p-2 rounded-md text-gray-100 inline-flex items-center">
                                            編集
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
