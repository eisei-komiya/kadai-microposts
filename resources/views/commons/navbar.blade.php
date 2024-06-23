<header class="fixed w-full z-20">
<nav class="navbar bg-neutral text-neutral-content w-full">
    {{-- トップページへのリンク --}}
    <div class="flex flex-1 md:gap-1 lg:gap-2">
        <h1><a class="btn btn-ghost normal-case text-xl" href="/">Microposts</a></h1>
    </div>

    <div class="flex-0">
        <div class="dropdown items-center">
            <div tabindex="0" role="button" class="btn m-1">
                Theme
                <svg width="12px" height="12px" class="h-2 w-2 fill-current opacity-60 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                    <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                </svg>
            </div>
            <ul tabindex="0" class="dropdown-content z-200 p-2 shadow-2xl bg-base-300 rounded-box w-52 max-h-80 overflow-y-auto">
                @foreach ([
                    'default', 'light', 'dark', 'cupcake', 'bumblebee', 'emerald', 'corporate', 
                    'synthwave', 'retro', 'cyberpunk', 'valentine', 'halloween', 'garden', 
                    'forest', 'aqua', 'lofi', 'pastel', 'fantasy', 'wireframe', 'black', 
                    'luxury', 'dracula', 'cmyk', 'autumn', 'business', 'acid', 'lemonade', 
                    'night', 'coffee', 'winter', 'dim', 'nord', 'sunset'
                ] as $theme)
                    <li data-theme="{{ $theme }}">
                        <input type="radio" name="theme-dropdown" class="theme-controller hidden" aria-label="{{ ucfirst($theme) }}" value="{{ $theme }}">
                        <label for="theme-dropdown" class="flex items-center gap-2 p-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="invisible h-3 w-3 shrink-0">
                                <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"></path>
                            </svg>
                            <span class="flex-grow text-sm">{{ ucfirst($theme) }}</span>
                            <span class="flex h-full shrink-0 flex-wrap gap-1">
                                <span class="bg-primary rounded-badge w-2 h-2"></span>
                                <span class="bg-secondary rounded-badge w-2 h-2"></span>
                                <span class="bg-accent rounded-badge w-2 h-2"></span>
                                <span class="bg-neutral rounded-badge w-2 h-2"></span>
                            </span>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <ul tabindex="0" class="menu hidden lg:menu-horizontal">
                @include('commons.link_items')
            </ul>
            <div class="relative z-50 dropdown dropdown-end">
                <button type="button" tabindex="0" class="btn btn-ghost normal-case font-normal lg:hidden">
                    @if (Auth::check())
                        {{ Auth::user()->name }}
                    @else
                        Guest
                    @endif
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52 text-info flex-0">
                    @include('commons.link_items')
                </ul>
            </div>
        </form>
    </div>
</nav>

</header>