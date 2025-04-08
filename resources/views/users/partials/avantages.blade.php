<section class="max-w-[1000px] bg-neutral-50 dark:bg-zinc-700 rounded-md shadow pt-12 pb-12 px-6 md:px-16">
    <div class="flex flex-col gap-1 w-full mb-10">     
        <h1 class="text-3xl font-semibold dark:text-white">Points de fidélité</h1>
        <p class="text-md dark:text-zinc-300 text-zinc-400">10 points vous confère une place gratuite !</p>
    </div>
    <div class="relative">
        <p class="text-base dark:text-white">Vous avez <span class="text-yellow-500 dark:text-yellow-300 px-2 font-semibold text-2xl" id ="fidelityCount">{{$user->points_fidelite}}</span> points de fidelité.</p>
    </div>
</section>