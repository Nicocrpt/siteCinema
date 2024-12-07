<li x-show="{{$show}}" x-transition:enter="transition ease-in-out duration-300 {{$delay}}" x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0">
    <a href="{{$href}}">{{$content}}</a>
</li>