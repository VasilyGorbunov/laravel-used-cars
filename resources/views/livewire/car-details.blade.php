<div x-data="{'active': 'tab-1'}">
    <x-card color="bg-white border border-gray-200">
        <div class="w-full flex justify-center">
            <img class="max-h-[450px]" src="{{asset('storage/qashqai2.jpg')}}" alt="">
        </div>
        <div class="flex items-center justify-center bg-gray-100 gap-2 mt-4 px-6 py-3 w-full overflow-x-auto">
            @foreach($car->images as $image)
                <img class="h-20"
                     x-on:click="alert($event.target.getAttribute('src'))"
                     src="{{ asset("storage/$image")  }}"
                     alt="">
            @endforeach
        </div>

        <div class="mt-4 border-b border-gray-200">
            <nav class="flex space-x-1">
                <button x-on:click="active = 'tab-1'"
                        type="button"
                        :class="{
                            'bg-white border-b-transparent text-blue-600 ': active == 'tab-1',
                            'bg-gray-50 text-gray-500': active != 'tab-1'
                        }"
                        class="-mb-px py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium text-center border rounded-t-lg hover:text-gray-700">
                    Tab 1
                </button>
                <button x-on:click="active = 'tab-2'"
                        type="button"
                        :class="{
                            'bg-white border-b-transparent text-blue-600 ': active == 'tab-2',
                            'bg-gray-50 text-gray-500': active != 'tab-2'
                        }"
                        class="-mb-px py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium text-center border rounded-t-lg hover:text-gray-700">
                    Tab 2
                </button>
            </nav>
        </div>

        <div class="mt-3">
            <div x-show="active == 'tab-1'" x-cloak>
                <p class="text-gray-500">
                    This is the <em class="font-semibold text-gray-800">first</em> item's tab body
                </p>
            </div>
            <div x-show="active == 'tab-2'" x-cloak>
                <p class="text-gray-500">
                    This is the <em class="font-semibold text-gray-800">second</em> item's tab body
                </p>
            </div>
        </div>
    </x-card>
</div>
