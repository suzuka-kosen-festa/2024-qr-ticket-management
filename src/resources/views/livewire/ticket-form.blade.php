<section class="bg-white p-4 border border-gray-200 rounded-lg">
    @if($ticketList->isEmpty())
        <p class="mt-4 text-gray-600">現在は整理券の配布を停止もしくは、配布可能な整理券がありません。</p>
    @else

        @if (session('error'))
            <x-flash-error>{{ session('error') }}</x-flash-error>
        @endif

        @foreach ($ticketList as $date => $tickets)
            <div class="mt-3 mb-3">
                <h3 class="text-xl font-semibold ml-2 mb-2 text-gray-800">
                    {{ \Carbon\Carbon::parse($date)->format('m月d日') }} の整理券
                </h3>

                <p class="p-2">
                    以下の整理券のみ選択可能です。
                </p>

                <div class="space-y-2">
                    <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                        @foreach ($tickets as $ticket)
                            <li class="w-full border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center ps-3">

                                    <label class="flex items-center space-x-2">
                                        <input type="radio" wire:model="ticket_id" value="{{ $ticket['id'] }}" class="w-4 h-4 bg-gray-100 border-gray-300">
                                        <span class="w-full py-3 ms-2 text-sm font-medium {{ $ticket['balance'] <= 5 ? 'text-red-500' : 'text-gray-900' }}">
                                            {{ $ticket['title'] }} (残り: {{ $ticket['balance'] }} グループ)
                                        </span>
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

        @if($errors->first('ticket_id'))
            <x-flash-error>{{ $errors->first('ticket_id') }}</x-flash-error>
        @endif
    @endif

    @if($ticketList->isNotEmpty())
        <div x-data="{ agreed: false }" class="mt-4">
            <div x-show="$ticketList->isNotEmpty()">
                @include('common.conditions')

                <div class="flex items-center mt-2">
                    <input id="link-checkbox" type="checkbox" x-model="agreed" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-900">上記の内容を理解しました。</label>
                </div>
            </div>

            <div class="flex items-center justify-center my-4">
                <button
                    :disabled="!agreed"
                    :class="agreed ? 'bg-pink-600 hover:bg-pink-700' : 'bg-gray-400 cursor-not-allowed'"
                    class="inline-flex items-center px-4 py-2 font-semibold text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 rounded-lg transition duration-150 ease-in-out"
                    wire:click="submitTicket"
                    >
                    選択を送信
                </button>
            </div>
        </div>
    @endif
</section>
