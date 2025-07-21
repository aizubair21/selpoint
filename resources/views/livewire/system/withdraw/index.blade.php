<div>
    <x-dashboard.page-header>
        Withdraws
    </x-dashboard.page-header>

    
    <x-dashboard.container>
        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Total
                </x-slot>
                <x-slot name="content">
                    20000
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending
                </x-slot>
                <x-slot name="content">
                    200
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Rejected
                </x-slot>
                <x-slot name="content">
                    20000
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Paid
                </x-slot>
                <x-slot name="content">
                    20000
                </x-slot>
            </x-dashboard.overview.div>
        </x-dashboard.overview.section>


        <x-dashboard.section>

            <x-dashboard.section.header>

                <x-slot name="title">
                    {{-- Pending Withdraw --}}
                    
                </x-slot>
                <x-slot name="content">
                    <div class="flex justify-between items-center">

                        <div>
                            <select wire:model.live="fst" class="rounded border" id="filter_status">
                                <option value="Pending">Pending</option>
                                <option value="Accept">Accepted</option>
                                <option value="Reject">Rejected</option>
                            </select>
                        </div>
    
                        <div class="flex space-x-2">
                            <x-secondary-button>
                                <i class="fas fa-filter"></i>
                            </x-secondary-button>
                            <x-text-input type="date" class="w-24" />
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
                        <tr @class(["bg-gray-200 font-bold" => !$item->seen_by_admin])>
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
                                    <x-nav-link href="{{route('system.withdraw.view', ['id' => $item->id])}}" >Details</x-nav-link>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard.table>
            
        </x-dashboard.section>
    </x-dashboard.container>
</div>
