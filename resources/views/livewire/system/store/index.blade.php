<div>
    <x-dashboard.page-header>
        Coin Store
    </x-dashboard.page-header>

    <x-dashboard.container>
        <div class="">
            <div class="">
                <x-dashboard.section>
                    <x-dashboard.section.inner>
                        <div>
                            @livewire('system.store.coin-store', key('coin-store'))
                        </div>

                    </x-dashboard.section.inner>
                </x-dashboard.section>

                <div class=" ">
                    <x-dashboard.section>
                        @livewire('system.store.coast-store', key('coast-store'))
                    </x-dashboard.section>

                    <x-dashboard.section>
                        @livewire('system.store.donation-store', key('donation-store'))
                    </x-dashboard.section>
                </div>
                <x-hr />
            </div>

            {{-- <div class="w-full">
                <x-dashboard.section>
                    <x-dashboard.section.header>
                        <x-slot name="title">
                            Transactions
                        </x-slot>
                        <x-slot name="content">

                            <div class="flex justify-between">
                                <div>
                                    <x-nav-link :active="$nav == 'store'" href="?nav=store">Store</x-nav-link>
                                    <x-nav-link :active="$nav == 'donation'" href="?nav=donation">Domain</x-nav-link>
                                    <x-nav-link :active="$nav == 'cost'" href="?nav=cost">Server</x-nav-link>
                                </div>
                                <div @class(['block','hidden'=> $nav != 'store'])>
                                    <select name="" class="rounded border shadow" id="">
                                        <option value="diposit">In</option>
                                        <option value="Withdraw">Out</option>
                                    </select>
                                </div>
                            </div>
                        </x-slot>
                    </x-dashboard.section.header>

                    <x-dashboard.section.inner>

                        @if(!empty($strack))

                        @if($nav == 'store')
                        <div class="px-3 mt-1 row m-0 align-items-start">

                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <h4 class="P-0 m-0">Give</h4>
                                    <div class="px-2 rounded bg-success text-white fw-bold ms-2">{{ $strack->where('to',
                                        '!=', 'admin')->sum('amount') }} Coins</div>
                                </div>
                                <hr>
                                @foreach ($strack as $st)
                                @if ($st->to != 'admin')

                                <div class="d-flex p-2 mb-1 alert alert-info d-block">
                                    <div class="me-4">
                                        {{ $st->created_at->diffForHumans() }}
                                        <br>
                                        {{ $st->created_at }}

                                    </div>
                                    @if ($st->to == 'admin')

                                    <div>
                                        You Store {{$st->amount}}TK to {{$st->to != 'admin' ? $st->to : 'server'}} <br>
                                        - {{$st->info}}
                                    </div>

                                    @else
                                    <div class="">
                                        You give {{$st->amount}}TK comission to {{$st->to != 'admin' ? $st->to :
                                        'server'}} <br> - {{$st->info}}
                                    </div>
                                    @endif
                                </div>

                                @endif
                                @endforeach
                            </div>

                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <h4 class="p-0 m-0">Store</h4>
                                    <div class="px-2 rounded bg-success text-white fw-bold ms-2">{{ $strack->where('to',
                                        '=', 'admin')->sum('amount') }} Coins</div>
                                </div>
                                <hr>
                                @foreach ($strack as $st)

                                @if ($st->to == 'admin')
                                <div class="d-flex p-2 mb-1 alert alert-success">
                                    <div class="me-4">
                                        {{ $st->created_at->diffForHumans() }}
                                        <br>
                                        {{ $st->created_at }}

                                    </div>
                                    @if ($st->to == 'admin')

                                    <div>
                                        You Store {{$st->amount}}TK to {{$st->to != 'admin' ? $st->to : 'server'}} <br>
                                        - {{$st->info}}
                                    </div>

                                    @else
                                    <div class="">
                                        You give {{$st->amount}}TK comission to {{$st->to != 'admin' ? $st->to :
                                        'server'}} <br> - {{$st->info}}
                                    </div>
                                    @endif
                                </div>

                                @endif
                                @endforeach
                            </div>

                        </div>
                        @endif


                        @if($nav == 'donation')
                        <div class="px-3 mt-1 row m-0 align-items-start">

                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <h4 class="P-0 m-0">Give</h4>
                                    <div class="px-2 rounded bg-success text-white fw-bold ms-2">{{ $strack->where('to',
                                        '!=', 'admin')->sum('amount') }} Coins</div>
                                </div>
                                <hr>
                                @foreach ($strack as $st)
                                @if ($st->to != 'admin')

                                <div class="d-flex p-2 mb-1 alert alert-info d-block">
                                    <div class="me-4">
                                        {{ $st->created_at->diffForHumans() }}
                                        <br>
                                        {{ $st->created_at }}

                                    </div>

                                    <div class="">
                                        You give {{$st->amount}}TK domain fund to {{$st->to }} <br> - {{$st->info}}
                                    </div>
                                </div>

                                @endif
                                @endforeach
                            </div>

                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <h4 class="P-0 m-0">store</h4>
                                    <div class="px-2 rounded bg-success text-white fw-bold ms-2">{{ $strack->where('to',
                                        '=', 'admin')->sum('amount') }} Coins</div>
                                </div>
                                <hr>
                                @foreach ($strack as $st)

                                @if ($st->to == 'admin')
                                <div class="d-flex p-2 mb-1 alert alert-success">
                                    <div class="me-4">
                                        {{ $st->created_at->diffForHumans() }}
                                        <br>
                                        {{ $st->created_at }}

                                    </div>

                                    <div>
                                        You received {{$st->amount}}TK charge <br> - {{$st->info}}
                                    </div>


                                </div>

                                @endif
                                @endforeach
                            </div>

                        </div>
                        @endif


                        @if($nav == 'cost')
                        <div class="px-3 mt-1 row m-0 align-items-start">

                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <h4 class="P-0 m-0">Give</h4>
                                    <div class="px-2 rounded bg-success text-white fw-bold ms-2">{{ $strack->where('to',
                                        '!=', 'admin')->sum('amount') }} Coins</div>
                                </div>
                                <hr>
                                @foreach ($strack as $st)
                                @if ($st->to != 'admin')

                                <div class="d-flex p-2 mb-1 alert alert-info d-block">
                                    <div class="me-4">
                                        {{ $st->created_at->diffForHumans() }}
                                        <br>
                                        {{ $st->created_at }}

                                    </div>

                                    <div class="">
                                        You spent {{$st->amount}}TK, cost <br> - {{$st->info}}
                                    </div>
                                </div>

                                @endif
                                @endforeach
                            </div>

                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <h4 class="P-0 m-0">Store</h4>
                                    <div class="px-2 rounded bg-success text-white fw-bold ms-2">{{ $strack->where('to',
                                        '=', 'admin')->sum('amount') }} Coins</div>
                                </div>
                                <hr>
                                @foreach ($strack as $st)

                                @if ($st->to == 'admin')
                                <div class="d-flex p-2 mb-1 alert alert-success">
                                    <div class="me-4">
                                        {{ $st->created_at->diffForHumans() }}
                                        <br>
                                        {{ $st->created_at }}

                                    </div>

                                    <div>
                                        You Received {{$st->amount}}TK charge <br> - {{$st->info}}
                                    </div>


                                </div>

                                @endif
                                @endforeach
                            </div>

                        </div>
                        @endif
                        @else
                        <div class="bold text-red-900">
                            No Transaction Found !
                        </div>
                        @endisset
                    </x-dashboard.section.inner>
                </x-dashboard.section>
            </div> --}}
        </div>
    </x-dashboard.container>
</div>