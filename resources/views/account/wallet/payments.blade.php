<!-- Navigation -->
@include('account.wallet.navigation')

<!-- Content -->
<div class="row mt-3">
    <!-- Check data -->
    @if(isset($payments) && count($payments) > 0) <!-- Payments -->
        <!-- Table Container -->
        <div class="table-responisve w-100">
            <table class="table payments-table table-striped table-hover table-bordered align-items-center">
                <thead>
                    <tr>
                        <th scope="col">{{ translating('#') }}</th>
                        <th scope="col">{{ translating('payment-method') }}</th>
                        <th scope="col">{{ translating('price') }}</th>
                        <th scope="col">{{ translating('date-time') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $payment)
                        <tr>
                            <!-- ID -->
                            <th scope="row">{{ ++$key }}</th>

                            <!-- Payment Method -->
                            <td>
                                <!-- Image -->
                                <img width="100px" class="lazy" src="{{ asset('assets/img/payment-methods/placeholder/placeholder.gif') }}" data-src="{{ asset($assets_path.'/img/payment-methods'.'/'.$payment->payment_method['img']) }}" alt="{{ $payment->payment_method['title_'.app()->getLocale()] }}">

                                <!-- Title -->
                                <span class="pl-2 d-md-inline d-none">{{ $payment->payment_method['title_'.app()->getLocale()] }}</span>
                            </td>

                            <!-- Price -->
                            <td>{{ price_handler($payment->price, $currency->value) }}</td>

                            <!-- Date Time -->
                            <td>{{ date_default_format($payment->created_at) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="row no-gutters mt-5">
            {{ $payments->links() }}
        </div>
    @else <!-- Not any payments -->
        <!-- Description -->
        <p class="w-100 h5">{{ translating('you-are-not-any-payments-now') }}</p>
    @endif
</div>
