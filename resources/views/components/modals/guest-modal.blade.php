<div x-show="guestModal" x-data="{translate: 0}" class="absolute h-screen w-screen flex justify-center items-center left-0 top-0 bg-black bg-opacity-50 backdrop-blur z-50"
x-transition:enter="transition-all ease-in-out duration-300"
x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
x-transition:leave="transition-all ease-in-out duration-300"
x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div @click.away="guestModal = false; setTimeout(function() {translate = 0}, 300)" class="overflow-hidden w-[95%] max-w-[700px] bg-gray-50 dark:bg-zinc-900 rounded-md shadow-lg flex flex-col justify-center gap-4 items-center z-50 py-4">
        <div class="w-full max-w-[500px] flex flex-col gap-4 justify-center items-center overflow-hidden">
            <h1 class="text-2xl dark:text-white font-semibold">Vous n'êtes pas connecté</h1>
            <div class="flex transition-all ease-in-out duration-300 w-full rounded-lg" :style="translate ? `transform: translateX(-${translate}%)` : ``">
                <div class="w-full h-parent justify-center flex-shrink-0 flex flex-col gap-4 z-50 px-4" x-transition:enter="transition-all ease-in-out duration-500" x-transition:enter-start="opacity-100" x-transition:enter-end="opacity-0" x-transition:leave="transition-all ease-in-out duration-500" x-transition:leave-start="opacity-0" x-transition:leave-end="opacity-100">
                    <button @click="translate = 100" class=" w-full h-12 flex-shrink-0 bg-cyan-700 hover:bg-cyan-600 text-white py-2 px-4 border-l border-l-cyan-900 rounded-md transition-all ease-in-out duration-300 flex justify-center items-center"><span>Me connecter</span></button>
                    <a href="{{ route('register') }}" class="w-full h-12 flex-shrink-0 flex justify-center items-center bg-cyan-700 hover:bg-cyan-600 text-white py-2 px-4 border-l border-l-cyan-900 rounded-md transition-all ease-in-out duration-300"><p>M'inscrire</p></a>
                </div>
                
                <div class="w-full flex-shrink-0 flex flex-col gap-2 z-50 px-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                
                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                
                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                
                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                
                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-zinc-900 border-zinc-300 dark:border-zinc-700 text-sky-600 shadow-sm focus:ring-sky-500 dark:focus:ring-sky-600 dark:focus:ring-offset-zinc-800" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                
                        <div class="flex flex-col gap-3 items-center justify-end mt-4">
                            <div class="flex justify-center items-center gap-4">
                                <a href="{{route('register')}}" class="underline text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 dark:focus:ring-offset-zinc-800">{{ __('Don\'t have an account?') }}</a>
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 dark:focus:ring-offset-zinc-800" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            
                
                            <x-primary-button class="ms-3">
                                {{ __('Login') }}
                            </x-primary-button>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
        
        
    </div>
</div>