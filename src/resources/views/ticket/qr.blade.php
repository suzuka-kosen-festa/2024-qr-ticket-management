<x-guest-layout>
    <div class="min-h-screen flex justify-center">
        <div class="px-3 py-6 w-full max-w-3xl">
            <div class="w-full text-left">
                <h2 class="p-2 text-2xl font-semibold text-gray-800">
                    チケット QR コード
                </h2>

                <section class="bg-white p-4 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800">チケット情報</h3>

                    <div class="text-left space-y-4 p-4 border-l-4 border-pink-500 my-4 bg-pink-50">
                        <p class="flex items-center">
                            <span class="font-bold">入場時間:</span> {{ $ticket->title }}
                        </p>
                        <p class="text-sm">入場の際には、以下のQRコードをご提示ください。画面のスクリーンショットをあらかじめ撮影しておくとスムーズにご案内できます。</p>
                    </div>

                    <div class="flex justify-center my-4">
                        {!! QrCode::size(250)->generate($ticket_log->unique_code) !!}
                    </div>
                    
                    @include('common.conditions')
                </section>
            </div>
        </div>
    </div>
</x-guest-layout>
