 <div class="row modules-tabs">
     {{-- tabs  start --}}
     <div class="tabs-container">
         <div class="tabs">
            <div class="tab-links">
                <button class="tab-link active" data-tab="tab-1">Find</button>
                <button class="tab-link" data-tab="tab-2">Booking</button>
                <button class="tab-link" data-tab="tab-3">BL Parties</button>
                <button class="tab-link" data-tab="tab-4">CGO/CONT</button>
                <button class="tab-link" data-tab="tab-5">Charges</button>
                <button class="tab-link" data-tab="tab-6">PSA/AN</button>
                <button class="tab-link" data-tab="tab-7">HBL View</button>
                <button class="tab-link" data-tab="tab-8">Notify</button>

                <div class="tab-indicator"></div>
            </div>
             
            {{-- Receive tab content --}}
            {!! $tabContents ?? '' !!}

         </div>
     </div>
     {{-- tabs  end --}}
 </div>
