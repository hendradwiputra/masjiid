@for ($i=1; $i<=6; $i++) <div
    class="flex text-stone-200 lg:text-xl rounded-lg bg-gradient-to-b from-stone-800 to to-stone-400 md:py-2"
    id="{{ $i }}">
    <div class="mx-auto">
        <h4 class="font-semibold text-xl lg:text-4xl text-shadow-lg text-shadow-gray-700 mb-1" id="praynames{{ $i }}">
        </h4>
        <h3 class="font-bold text-2xl lg:text-7xl leading-4 lg:leading-14 text-shadow-lg text-shadow-gray-700 mb-1"
            id="praytimes{{ $i }}">
        </h3>
    </div>
    </div>
    @endfor