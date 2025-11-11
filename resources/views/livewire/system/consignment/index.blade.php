<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <x-dashboard.page-header>
        Consignment
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <select wire:model.live="type" class="py-1 rounded-md " id="">
                                <option value="All">All</option>
                                <option value="Pending">Pending</option>
                                <option value="Received">Received</option>
                                <option value="Completed">Complete</option>
                                <option value="Returned">Returned</option>
                            </select>
                        </div>

                        <div class="flex gap-2 items-center">
                            <x-text-input type="date" wire:model.live='sdate' />
                            <x-text-input type="date" wire:model.live='edate' />
                        </div>
                    </div>
                </x-slot>

                <x-slot name="content"></x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                {{$cod->links()}}

                <x-dashboard.table>
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Amount</td>
                            <td>Rider Amount</td>
                            <td>Total</td>
                            <td>Comission</td>
                            <td>C Rate</td>
                            <td>Status</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cod as $item)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$item->amount}} </td>
                            <td> {{$item->rider_amount}} </td>
                            <td> {{$item->total_amount}} </td>
                            <td> {{$item->system_comission}} </td>
                            <td> {{$item->comission}} </td>
                            <td> {{$item->status}} </td>
                            <td> {{Carbon\Carbon::parse($item->created_at)->format('Y-M-d')}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                {{count($cod)}}
                            </td>
                            <td> {{$cod->sum('amount')}} </td>
                            <td> {{$cod->sum('rider_amount')}} </td>
                            <td> {{$cod->sum('total_amount')}} </td>
                            <td> {{$cod->sum('system_comission')}} </td>
                            <td> {{$cod->sum('comission')}} </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>

</div>