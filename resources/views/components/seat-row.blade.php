<div class="space-y-2">
    <!-- 1ère rangée -->
        <div class="grid grid-cols-custom gap-2 w-full" x-data="seats('A')">
            {{-- <div :class="{selected: isChoosed('A01')}" class="seat" id="A01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%" @click="toggleSeat"></div> --}}
            <x-seat seat="{{$rangee}}{{$numero}}" />
            <x-seat seat="A02" />
            <x-seat seat="A03" />
            <x-seat seat="A04" />
            <div> </div>                
            <x-seat seat="A05" />
            <x-seat seat="A06" />
            <x-seat seat="A07" />
            <x-seat seat="A08" />
            <x-seat seat="A09" />
            <x-seat seat="A10" />
            <x-seat seat="A11" />
            <x-seat seat="A12" />
            <x-seat seat="A13" />
            <x-seat seat="A14" />
            <div> </div>
            <x-seat seat="A15" />
            <x-seat seat="A16" />
            <x-seat seat="A17" />
            <x-seat seat="A18" />
        </div>
</div>