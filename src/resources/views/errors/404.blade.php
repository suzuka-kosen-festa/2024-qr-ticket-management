<x-guest-layout>
    <div class="mt-8 container mx-auto">
        <div class="mx-auto max-w-4xl">
            <div class="bg-white sm:rounded-xl py-6 px-8 space-y-6">
                <div class="flex flex-col mb-4 items-start">
                    <h1 class="font-bold text-2xl">404 - ページが見つかりません</h1>
                    <div class="p-2">
                        <p>お探しのページは存在しないか、移動された可能性があります。</p>
                    </div>
                </div>

                <div class="flex justify-center">
                    <x-button.primary-link href="{{ url('/') }}" text="ホームに戻る"/>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
