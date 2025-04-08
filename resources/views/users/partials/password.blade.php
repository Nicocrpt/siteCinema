<section class="max-w-[1000px] bg-neutral-50 dark:bg-zinc-700 rounded-md shadow pt-12 pb-12 px-6 md:px-16 mt-24">
    <div class="flex flex-col gap-1 w-full mb-10">     
        <h1 class="text-3xl font-semibold dark:text-white">Reinitialisation du mot de passe</h1>
        <p class="text-md dark:text-zinc-300 text-zinc-400">Modifiez votre mot de passe</p>
    </div>
    <div class="relative">
        <form action="" id="passwordForm">
            <div class="flex gap-4 mt-10 w-full">
                <div class="w-full">
                    <x-input-label for="ActualPassword" :value="__('Mot de passe actuel')" />
                    @error('ActualPassword')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block text-black dark:text-white" type="text" name="Nom" id="Nom" value="" >
                </div>
                <div class="w-full">
                    <x-input-label for="NewPassword" :value="__('Nouveau mot de passe')" />
                    @error('NewPassword')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block text-black dark:text-white" type="text" name="Prenom" id="Prenom" value="">
                </div>
            </div>
            <div class="mt-6 flex w-full justify-end">
                <button class="px-4 py-2 rounded bg-black text-white">Modifier</button>
            </div>
        </form>

    </div>
</section>