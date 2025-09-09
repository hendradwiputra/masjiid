<div class="mx-auto w-full">
    <div class="font-mavenpro">

        <!-- Running Text -->
        @include('livewire.notification.running-text-display')
        <!-- End of running-text -->

        <!-- Copyright -->
        <div id="copyright">
            <div class="w-full bg-gradient-to-l from-stone-800 to bg-stone-400">
                <div
                    class="flex flex-col items-center justify-center sm:flex-row sm:justify-between mx-1 text-center sm:text-left">
                    <p class="text-stone-800 text-xs md:text-sm font-medium tracking-wide">
                        &copy; Copyright {{ now()->year}} <strong>Masjiid</strong>. All rights reserved.
                    </p>
                    <div class="flex gap-4">
                        <ul class="flex flex-col">
                            <li class="flex" id="contact_no"></li>
                        </ul>
                        <ul class="flex flex-col">
                            <li class="flex">
                                <span>
                                    <a href="/dashboard" target="_blank"
                                        class="inline-flex items-center text-white text-xs tracking-wide space-x-1 ml-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        </svg>
                                        <span class="text-xs md:text-sm">Settings</span>
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of copyright -->

    </div>
</div>