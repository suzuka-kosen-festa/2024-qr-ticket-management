<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('admin.common.pageLink')

            <x-input-error :messages="$errors->all()" />

            <form action="{{ route('admin.ticket.update', ['id' => $ticket->id]) }}" method="POST">
                @csrf

                <div class="bg-white p-4 rounded-md my-4 w-full">
                    <!-- タイトル -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">タイトル</label>
                        <x-text-input id="title" name="title" value="{{ old('title', $ticket->title) }}" required />
                    </div>

                    <!-- イベント日 -->
                    <div class="mb-4">
                        <label for="event_date" class="block text-gray-700">イベント日</label>
                        <x-text-input type="date" id="event_date" name="event_date" value="{{ old('event_date', $ticket->event_date) }}" required />
                    </div>

                    <!-- 販売開始時間 -->
                    <div class="mb-4">
                        <label for="sale_start_time" class="block text-gray-700">販売開始時間</label>
                        <x-text-input type="datetime-local" id="sale_start_time" name="sale_start_time" value="{{ old('sale_start_time', $ticket->sale_start_time) }}" required />
                    </div>

                    <!-- 終了時間 -->
                    <div class="mb-4">
                        <label for="end_time" class="block text-gray-700">終了時間</label>
                        <x-text-input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time', $ticket->end_time) }}" required />
                    </div>

                    <!-- 最大数 -->
                    <div class="mb-4">
                        <label for="max_count" class="block text-gray-700">最大数</label>
                        <x-text-input type="number" id="max_count" name="max_count" value="{{ old('max_count', $ticket->max_count) }}" required />
                    </div>

                    <!-- 残り -->
                    <div class="mb-4">
                        <label for="balance" class="block text-gray-700">残り(注意！！)</label>
                        <x-text-input type="number" id="balance" name="balance" value="{{ old('balance', $ticket->balance) }}" required />
                    </div>

                    <!-- 更新ボタン -->
                    <div class="mb-4">
                        <x-button.primary>更新する</x-button.primary>
                    </div>

                    @if (session('success'))
                        <x-flash-success>
                            {{ session('success') }}
                        </x-flash-success>
                    @endif
                </div>

            </form>

            <section class="bg-white p-4 rounded-md my-4 w-full">
                    @if($ticketLogList->isNotEmpty())
                        <div class="grid gap-4">
                            @foreach ($ticketLogList as $log)
                                <div class="p-4 border border-gray-200">
                                    <p class="text-gray-700 text-sm font-semibold">日付: <span class="text-gray-900">{{ $log->created_at->format('Y年m月d日 H:i') }}</span></p>

                                    <p class="mt-2 text-gray-700 text-sm font-semibold">ステータス:
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ !is_null($log->status) ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                            {{ !is_null($log->status) ? '入場済み' : '未入場' }}
                                        </span>
                                    </p>

                                    <p class="mt-2 text-gray-700 text-sm font-semibold">チケットコード:
                                        <span class="text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">{{ $log->unique_code }}</span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-center py-6">取得履歴がありません。</p>
                    @endif
            </section>
        </div>
    </div>
</x-app-layout>
