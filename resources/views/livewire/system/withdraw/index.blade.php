<div>
    <x-dashboard.page-header>
        Withdraws
    </x-dashboard.page-header>


    <x-dashboard.container x-init="$wire.getWithdraw">
        <x-dashboard.overview.section x-loading.disabled>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Amount
                </x-slot>
                <x-slot name="content">
                    {{$withdraw?->sum('amount')}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Payable
                </x-slot>
                <x-slot name="content">
                    {{$withdraw?->sum('payable_amount')}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Comission
                </x-slot>
                <x-slot name="content">
                    {{$withdraw?->sum('server_fee')}} | {{$withdraw?->sum('maintenance_fee')}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Paid
                </x-slot>
                <x-slot name="content">
                    {{$paid}}
                </x-slot>
            </x-dashboard.overview.div>
        </x-dashboard.overview.section>


        <x-dashboard.section>

            <x-dashboard.section.header>

                <x-slot name="title">
                    {{-- Pending Withdraw --}}

                </x-slot>
                <x-slot name="content">
                    <div class="flex justify-between items-center overflow-x-scroll" style="scroll-behavior: smooth">

                        <div>
                            <select wire:model.live="fst" class="rounded border" id="filter_status">
                                <option value="Pending">Pending {{$pending}}</option>
                                <option value="Accept">Accepted {{$paid}}</option>
                                <option value="Reject">Rejected {{$reject}} </option>
                            </select>
                        </div>

                        <div class="flex space-x-2">
                            {{-- <x-primary-button @click="$dispatch('open-modal', 'withdraw-filter-modal')">
                                <i class="fas fa-filter"></i>
                            </x-primary-button> --}}

                            <x-text-input type="date" id="sdate" wire:model.live='sdate' class="w-24" />
                            <x-text-input type="date" id="edate" wire:model.live='edate' class="w-24" />
                        </div>

                    </div>
                </x-slot>

            </x-dashboard.section.header>

        </x-dashboard.section>
        <x-dashboard.section>
            {{$withdraw->links()}}

            <x-dashboard.table :data="$withdraw">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>A/C</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($withdraw as $item)
                    <tr @class(["bg-gray-200 font-bold"=> !$item->seen_by_admin])>
                        <td> {{$loop->iteration}} </td>
                        <td> {{$item->id}} </td>
                        <td>
                            <div>
                                <div class="flex">
                                    {{$item->user?->name}}
                                    @if ($item->user?->subscription)
                                    <span class="bg-indigo-900 text-white ms-1 px-1 rounded">
                                        vip
                                    </span>
                                    @endif
                                    <span class="bg-gray-900 text-white ms-1 px-1 rounded-full">
                                        U
                                    </span>
                                </div>

                                {{$item->user?->email}}
                            </div>
                        </td>
                        <td>
                            {{$item->amount ?? '0'}} TK
                        </td>
                        <td>
                            @if (!$item->is_rejected)
                            {{$item->status ? "Accept" : 'Pending'}}
                            @else
                            <div class="p-1">Reject</div>
                            @endif
                        </td>
                        <td>
                            {{$item->created_at?->toFormattedDateString() }}
                        </td>
                        <td>
                            <div class="flex">
                                <x-nav-link href="{{route('system.withdraw.view', ['id' => $item->id])}}">Details
                                </x-nav-link>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </x-dashboard.table>

        </x-dashboard.section>
    </x-dashboard.container>

    <x-modal name="withdraw-filter-modal" maxWidth="sm">
        <div class="p-3">
            Filter
        </div>
        <hr />
        <div class="p-3">
            <div class="text-xs">Filter By Date</div>

        </div>
    </x-modal>
</div>