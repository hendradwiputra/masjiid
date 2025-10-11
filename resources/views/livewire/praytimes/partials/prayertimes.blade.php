@for ($i=1; $i<=6; $i++) <div
    class="flex text-stone-200 lg:text-xl rounded-lg bg-gradient-to-b from-stone-800 to to-stone-400 md:py-2"
    id="{{ $i }}">
    <div class="mx-auto">
        <h4 class="font-mavenpro font-semibold text-xl lg:text-4xl mb-1" id="praynames{{ $i }}"></h4>
        <h1 class="font-montserrat font-bold text-2xl lg:text-7xl leading-4 lg:leading-14 mb-1" id="praytimes{{ $i }}">
        </h1>
    </div>
    </div>
    @endfor