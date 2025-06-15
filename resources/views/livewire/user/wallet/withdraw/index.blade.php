<div class="p-2">  
    <x-dashboard.container>

        <x-dashboard.section>
             <x-dashboard.section.header>
                 <x-slot name="title">
                    <div class="flex justify-between items-start">
                        <div>
                            Your Wallet
                        </div>
                    </div>
                </x-slot>>
                 <x-slot name="content">
                     <div class="flex justify-between items-center">
                         <div class="text-2xl font-bold text-indigo-900"> {{auth()->user()->coin}} TK </div> 
                     </div>
                 </x-slot>
             </x-dashboard.section.header>
     
             <x-dashboard.section.inner>

                    <ul>
                        <li>
                            To make a withdrawal, your balance must be at least 500 TK. If you're a new user, you'll need to reach a minimum balance of 500 TK before you can withdraw.
                        </li>
                        <li>
                            To make a withdrawal, VIP and VIP Package users must first complete a product purchase.
                        </li>
                    </ul>
                   
                    <x-hr/>
                    <div class="space-x-2 mt-2 text-end">
                        <x-primary-button x-on:click="$dispatch('open-modal', 'request-payment-modal')">Request A Payment</x-primary-button>
                    </div>
             </x-dashboard.section.inner>
         </x-dashboard.section>

         <x-dashboard.section>
            <div class="flex items-center justify-between">
                <div>
                    Last Activity
                </div>
                <x-nav-link href="" > History </x-nav-link>

            </div>
            <div class="mt-2">
                <div class="row m-0">
                    @foreach ($withdraw as $wtd)
                        @if($wtd->status == 0 && $wtd->is_rejected == NULL)
                            <div class="col-sm-6 col-lg-4 py-3">
                                <div class="border border-info rounded text-left">
                                    <div class="py-2 px-3 border-bottom">
                                        <h6>Status</h6>
                                        <p class="text-info">Pending</p>
                                    </div>
                                    <div class="py-2 px-3 border-bottom">
                                        <h6>Amount</h6>
                                        <p>{{$wtd->amount}} TK</p>
                                    </div>
                                    <div class="py-2 px-3 border-bottom">
                                        <h6>Method</h6>
                                        <p> {{$wtd->pay_by}} </p>
                                        <p>
                                            A/C: {{$wtd->pay_to}}
                                        </p>
                                    </div>
                                    <div class="p-3">
                                        <h6>Date</h6>
                                        <p> {{$wtd->created_at}} <br>- {{ $wtd->created_at->diffForHumans() }} </p>
                                        <form @class(['d-block', 'd-none' => $wtd->is_rejected]) action="{{route('user.withdraw.destroy')}}" method="post">
                                            <input type="hidden" name="wid" value="{{$wtd->id}}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Cancel</button>

                                        </form>
                                        {{-- <a href="" class="btn btn-danger">Cancel</a> --}}
                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
         </x-dashboard.section>
    </x-dashboard.container>

    <x-modal name="request-payment-modal">
        <div class="p-3">
         <div class="text-lg p-3">Request Payment</div>
         <x-hr/>
         <div class="p-3">

            <form wire:submit.prevent="requestPayment">
                
                <div class="flex m-0 mb-3 space-x-2">
                    <div class="col-md-8">
                        <select wire:model.live="pay_by" id="bank_name" class=" rounded border-0 shadow-0 form-control form-select @error('pay_by') is-invalid @enderror">
                            <option value="">Payment Method</option>
                            <option selected value="bkash">Bkash</option>
                            <option value="nogod">Nogod</option>
                            <option value="roket">Roket</option>
                        </select>
                    </div>
                    <div class="space-y-3"> 
                        <x-text-input type="number" wire:model.live="amount" placeholder="Amount" />

                        <x-text-input type="number" wire:model.live="pay_to" id="account" class="form-control @error('pay_to') is-invalid @enderror" placeholder="Enter Payment Number" />
                    </div>
                </div>
                
            
                @error('pay_by')
                    <div class="text-xs text-red-900 d-block">
                        {{ $message }}
                    </div>
                @enderror
                @error('pay_to')
                    <div class="text-xs text-red-900 d-block">
                        {{ $message }}
                    </div>
                @enderror
                @error('amount')
                    <div class="text-xs text-red-900 d-block">
                        {{ $message }}
                    </div>
                @enderror
                <x-hr/>
                <div class="text-end flex justify-end items-center space-x-2">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'request-payment-modal')">cancel</x-secondary-button>
                    <x-primary-button>Submit</x-primary-button>
                </div>
            </form>
         </div>
        </div>
    </x-modal>
    
</div>
