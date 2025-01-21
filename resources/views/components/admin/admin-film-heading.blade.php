<div x-data="{currentPage: document.title}" class="relative h-12 max-h-16 w-full border-zinc-150 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-900 shadow-xs z-30">
    <ul class="flex dark:text-white h-full z-20">
        <li class="h-full w-fit p-2 px-4 z-30 flex items-center gap-2" :class="currentPage == 'Films - Gérer les films' ? 'border-b-2 border-zinc-950 dark:border-white' : ''">
            <svg width="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="fill-black dark:fill-white"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M17.928 9.628C17.837 9.399 15.611 4 10 4S2.162 9.399 2.07 9.628a1.017 1.017 0 000 .744C2.163 10.601 4.389 16 10 16c5.611 0 7.837-5.399 7.928-5.628a1.017 1.017 0 000-.744zM10 14a4 4 0 110-8 4 4 0 010 8zm0-6a2 2 0 10.002 4.001A2 2 0 009.999 8z" class="fill-black dark:fill-white"></path></g></svg>
            <a class="font-semibold"  href="{{route('admin.films.manage')}}">Gérer les films</a>
        </li>
        <li class="h-full w-fit p-2 px-4 z-30 flex items-center gap-2" :class="currentPage == 'Films - Ajouter un film' ? 'border-b-2 border-zinc-950 dark:border-white' : ''">
            <svg width="18" viewBox="0 0 24 24" class="fill-none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" class="stroke-black dark:stroke-white" stroke-width="2.4" stroke-linecap="round"></path> <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" class="stroke-black dark:stroke-white" stroke-width="2.4" stroke-linecap="round"></path> </g></svg>
            <a class=" font-semibold"  href="{{route('admin.films.searchPage')}}">Ajouter un film</a>
        </li>
    </ul>
    <div class="absolute bottom-0 w-full !h-[2px] bg-zinc-200 dark:bg-zinc-700 z-10"></div>
</div>