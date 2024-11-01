<header class="w-full h-16 bg-white border-b border-gray-200 flex items-center">
    <div class="px-3 w-full">
        <div class="flex flex-row items-center justify-between sm:px-10">
            <span class="text-gray-700 text-xs sm:text-sm font-medium me-4 rounded">
                adminでのログイン
            </span>

            @if(Auth::check())
                @include('common.assets.logout')
            @endif
        </div>
    </div>
</header>
