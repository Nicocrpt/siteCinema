<form action="{{route('users.update', $user->id)}}" method="POST" class="max-w-[1000px] bg-neutral-50 dark:bg-zinc-700 rounded-md shadow pt-12 pb-6 px-6 md:px-16">
    @csrf
    @method('PUT')
    <div class="flex gap-4 w-full justify-between items-center">

        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-semibold dark:text-white">Informations Personnelles</h1>
            <p class="text-md dark:text-zinc-300 text-zinc-400">Consultez ou mettez à jour vos informations</p>
        </div>
        
        <button @click="active_form = !active_form" type="button" class="dark:text-neutral-300 hover:text-sky-600">
            Modifier
        </button>
    </div>
    
    <div style="max-width: 1000px">
        <div class="flex gap-4 mt-10 w-full">
            <div class="w-full">
                <x-input-label for="Nom" :value="__('Nom')" />
                @error('Nom')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="text" name="Nom" id="Nom" value="{{ $user->nom }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
            </div>
            <div class="w-full">
                <x-input-label for="Prenom" :value="__('Prenom')" />
                <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="text" name="Prenom" id="Prenom" value="{{ $user->prenom }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
            </div>
        </div>
        <div class="mt-5">
            <x-input-label for="Email" :value="__('Email')" />
            <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="email" name="Mail" id="Mail" value="{{ $user->email }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
        </div>

        <div class="h-20 flex justify-end items-center">
            <button type="submit" @click="onUpdateUserInfoClick($event)" class="text-md text-white w-fit p-2 px-3  rounded-md bg-cyan-600 hover:bg-cyan-500 border-b-2 border-cyan-700 transition-all ease-in-out duration-200 cursor-pointer mt-6 shadow-sm" 
            x-show="active_form"
            x-transition:enter="transition transform ease-in-out duration-200"
            x-transition:enter-start="transform opacity-0"
            x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition transform ease-in-out duration-200"
            x-transition:leave-start="transform opacity-100"
            x-transition:leave-end="transform opacity-0"
            >Mettre à jour</button>
        </div>
        
    </div>  
</form>