@if ($salle->id === 1)
    <div class="w-full max-w-6xl border-solid border-2 border-gray-300 rounded-lg p-6 shadow-inner">
        <h1 class="text-2xl font-bold text-center mb-6">Disposition des Sièges</h1>
        <div class="grid grid-rows-12 gap-vw-2">
        
        
        <!-- Exemple pour une rangée -->
            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-28-custom gap-2">
                    
                    <div class="seat" id="A01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>

                    <!-- Séparation centrale -->
                    
                    <div class="seat" id="A07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat oqp" id="A09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat oqp" id="A10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A19"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>



                    <div class="seat" id="A23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat oqp" id="A24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat oqp" id="A25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat oqp" id="A26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A27"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A28"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>

                </div>
            </div>

            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="B01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="B07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B19"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="B23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B27"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="B28"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>

            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="C01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="C07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C19"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="C23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C27"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="C28"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>

            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="D01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="D07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D19"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="D23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D27"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="D28"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>

            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="E01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="E07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat oqp" id="E11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat oqp" id="E12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat oqp" id="E13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat oqp" id="E15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat oqp" id="E16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E19"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat oqp" id="E20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="E23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E27"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="E28"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>
                
            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="F01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="F07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat Hand col-span-2" id="F08"><img src="assets/handicap-svgrepo-com.svg" alt="" width="30%"></div>
                        <!-- <div class="seat"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div> -->
                        <div class="seat" id="F09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat Hand col-span-2" id="F19"><img src="assets/handicap-svgrepo-com.svg" alt="" width="30%"></div>
                        <!-- <div class="seat"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div> -->
                        <div class="seat" id="F20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="F21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="F26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>
            
            <div></div>
            <div></div>

            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="G01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="G07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat oqp" id="G14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat oqp" id="G15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G19"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="G23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G27"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="G28"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>

            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="H01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="H07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H19"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="H23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H27"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="H28"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>
            
            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="I01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="I07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I19"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="I23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I27"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="I28"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>

            <div class="space-y-2">
                <!-- 1ère rangée -->
                    <div class="grid grid-cols-28-custom gap-2">
                        
                        <div class="seat" id="J01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
                        <!-- Séparation centrale -->
                        
                        <div class="seat" id="J07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat Hand col-span-2" id="J08"><img src="assets/handicap-svgrepo-com.svg" alt="" width="30%"></div>
                        <!-- <div class="seat"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div> -->
                        <div class="seat" id="J09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat Hand col-span-2" id="J19"><img src="assets/handicap-svgrepo-com.svg" alt="" width="30%"></div>
                        <!-- <div class="seat"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div> -->
                        <div class="seat" id="J20"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div> </div>
        
        
        
                        <div class="seat" id="J21"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J22"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J23"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J24"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J25"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                        <div class="seat" id="J26"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
        
                    </div>
            </div>

        </div>


        <div class="screen flex bg-gray-300 justify-center text-gray-500 text-sm font-bold rounded-b-full shadow shadow-gray-500 items-center w-100">Ecran</div>


        <div class="sm:flex sm:flex-rows gap-10 justify-center items-center m-10">
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-red-400"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Occupé(s)</div>
            </div>
        
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-gray-300"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Libre(s)</div>
            </div>
        
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-green-400 border-solid border-2 border-gray-600"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Séléctionné(s)</div>
            </div>
        </div>

        


    </div>  
@elseif ($salle->id === 2)
    <div class="w-full max-w-2xl border-solid border-2 border-gray-300 rounded-lg p-6 shadow-inner">
        <h1 class="text-2xl font-bold text-center mb-6">Disposition des Sièges</h1>

        <div class="grid grid-rows-8 gap-vw-2">
        
        
        <!-- Exemple pour une rangée -->
            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">              
                    <div class="seat" id="A01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div></div>
                    <div class="seat" id="A11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>
            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">              
                    <div class="seat" id="B01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="B11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">              
                    <div class="seat" id="C01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="C11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">              
                    <div class="seat" id="D01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="D11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">              
                    <div class="seat" id="E01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="E11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>
                
            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">              
                    <div class="seat" id="F01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="F11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>
            
            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">              
                    <div class="seat" id="G01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="G11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">              
                    <div class="seat" id="H01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="H11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>
            

        </div>


        <div class="screen flex bg-yellow-200 justify-center text-gray-400 text-sm font-bold rounded-b-full shadow shadow-gray-500 items-center w-100">Ecran</div>


        <div class="sm:flex sm:flex-rows gap-10 justify-center items-center m-10">
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-red-400"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Occupé(s)</div>
            </div>
        
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-gray-300"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Libre(s)</div>
            </div>
        
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-green-400 border-solid border-2 border-gray-600"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Séléctionné(s)</div>
            </div>
        </div>

        


    </div>
@else
    <div class="w-full max-w-4xl border-solid border-2 border-gray-300 rounded-lg p-6 shadow-inner">
        <h1 class="text-2xl font-bold text-center mb-6" id="title"></h1>

        <div class="grid grid-rows-10 gap-vw-2">
        
        
        <!-- Exemple pour une rangée -->
            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="A01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="A05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="A15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="A18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="B01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="B05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="B15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="B18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="C01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="C05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="C15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="C18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="D01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="D05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="D15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="D18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="E01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="E05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="E15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="E18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>
                
            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="F01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="F05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="F15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="F18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div></div>
            
            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="G01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="G05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="G15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="G18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="H01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat"id="H03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="H05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="H15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="H18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

            <div class="space-y-2">
            <!-- 1ère rangée -->
                <div class="grid grid-cols-custom gap-2">
                    <div class="seat" id="I01"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I02"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I03"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I04"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>                
                    <div class="seat" id="I05"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I06"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I07"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I08"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I09"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I10"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I11"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I12"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I13"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I14"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div> </div>
                    <div class="seat" id="I15"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I16"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I17"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                    <div class="seat" id="I18"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                </div>
            </div>

        


            

        </div>


        <div class="screen flex bg-yellow-200 justify-center text-gray-400 text-sm font-bold rounded-b-full shadow shadow-gray-500 items-center w-100">Ecran</div>


        <div class="sm:flex sm:flex-rows gap-10 justify-center items-center m-10">
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-red-400"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Occupé(s)</div>
            </div>
        
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-gray-300"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Libre(s)</div>
            </div>
        
            <div class="flex flex-row items-center gap-2">
                <div class="seatDemo bg-green-400 border-solid border-2 border-gray-600"><img src="{{Storage::url('seats/seat.svg')}}" alt="" width="85%"></div>
                <div>Séléctionné(s)</div>
            </div>
        </div>

        


    </div>
@endif