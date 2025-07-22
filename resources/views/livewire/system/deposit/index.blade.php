<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.page-header>
        Deposit
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Deposit List
                </x-slot>
                <x-slot name="content">
                    <div class="flex space-x-1">
                        <select wire:model.live="status" id="">
                            <option value="0">Pending</option>
                            <option value="1">Confirmed</option>
                        </select>
                    </div>
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
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
                                    <x-nav-link-btn href="{{route('system.users.edit', ['id' => $item->user?->id])}}"> {{$item->user?->name ?? 'N/A'}} </x-nav-link-btn>
                                </td>
                                <td>{{ $item->amount ?? 0 }}</td>
                                <td>
                                    <div class="flex items-center">

                                        {{ $item->senderAccountNumber }} <i class="fas fa-caret-right px-2"></i> {{$item->paymentMethod}} <i class="fas fa-caret-right px-2"></i> {{$item->receiverAccountNumber}}
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
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
