<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.page-header>
        Deposit
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">

                </x-slot>
                <x-slot name="content">
                    <div class="lg:flex justify-between items-center space-x-1">
                        <select wire:model.live="status" id=""
                            class="py-1 mb-1 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500 focus:ring-1">
                            <option value="0">Pending</option>
                            <option value="1">Confirmed</option>
                        </select>

                        <div class="flex items-center space-x-2">
                            <x-text-input type="date" id="sdate" wire:model.live='sdate' class=" py-1" />
                            <x-text-input type="date" id="edate" wire:model.live='edate' class=" py-1" />
                        </div>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
            <br>
            {{$history->links()}}
            <x-dashboard.table :data="$history">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Trx ID</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>A/C</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{-- User Name --}}
                            <x-nav-link-btn href="{{route('system.users.edit', ['id' => $item->user?->id ?? ''])}}">
                                {{$item->user?->name ?? 'N/A'}}
                            </x-nav-link-btn>

                        </td>
                        <td>{{ $item->amount ?? 0 }}</td>
                        <td>
                            <div class="flex items-center">

                                {{ $item->senderAccountNumber }} <i class="fas fa-caret-right px-2"></i>
                                {{$item->paymentMethod}} <i class="fas fa-caret-right px-2"></i>
                                {{$item->receiverAccountNumber}}
                            </div>
                        </td>
                        <td>
                            {{ $item->transactionId ?? 'N/A' }}
                        </td>
                        <td>{{ $item->confirmed ? 'Confirmed' : 'Pending' }}</td>
                        <td>{{ $item->created_at->diffForHumans() }} </td>
                        <td>
                            <div class="flex">
                                <x-primary-button wire:click="confirmDeposit({{$item->id}})">
                                    <i class="fas fa-check"></i>
                                </x-primary-button>
                                <x-danger-button wire:click.prevent="denayDeposit({{$item->id}})">
                                    <i class="fas fa-times"></i>
                                </x-danger-button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right font-bold">Total</td>
                        <td class="font-bold">{{$history?->sum('amount')}}</td>
                        <td colspan="5"></td>
                    </tr>
                </tfoot>
            </x-dashboard.table>

        </x-dashboard.section>
    </x-dashboard.container>
</div>