<!-- Navigation -->
@include('account.wallet.navigation')

<!-- Content -->
<div class="row mt-3">
    <!-- Check data -->
    @if(isset($operations) && count($operations) > 0) <!-- operations -->
        <!-- Table Container -->
        <div class="table-responisve w-100">
            <table class="table operations-table table-striped table-hover table-bordered align-items-center">
                <thead>
                    <tr>
                        <th scope="col">{{ translating('#') }}</th>
                        <th scope="col">{{ translating('payment-method') }}</th>
                        <th scope="col">{{ translating('price') }}</th>
                        <th scope="col">{{ translating('date-time') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($operations as $key => $operation)
                        <tr>
                            <!-- ID -->
                            <th scope="row">{{ ++$key }}</th>
                            
                            <!-- Operation Method -->
                            <td>
                                <!-- Title -->
                                <span class="pl-2">{{ $operation->description }}</span>
                            </td>

                            <!-- Price -->
                            <td>{{ price_handler($operation->price, $currency->value) }}</td>
                            
                            <!-- Date Time -->
                            <td>{{ date_default_format($operation->created_at) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="row no-gutters w-100 mt-5">
            {{ $operations->links() }}
        </div>
    @else <!-- Not any operations -->
        <!-- Description -->
        <p class="w-100 h5">{{ translating('you-are-not-any-operations-now') }}</p>   
    @endif
</div>