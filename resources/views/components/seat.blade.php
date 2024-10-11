<div 
    :class="{selected: seats.includes('{{$seat}}')}" 
    class="seat" 
    id="{{$seat}}"
    @click="toggleSeat">
        <img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%" >
</div>