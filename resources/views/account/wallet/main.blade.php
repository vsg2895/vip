<!-- Navigation -->
@include('account.wallet.navigation')

<!-- Content -->
<div class="row no-gutters mt-3">
    <!-- Wallet Code -->
    <h4>{{ translating('wallet-code').' #'.Auth::user()->wallet['id'] }}</h4>

    <!-- Title -->
    <h4 class="w-100 d-block my-3">{{ translating('ballance-title') }}</h4>

    <!-- Ballance -->
    <div class="row no-gutters">
        <!-- Price -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <span class="3bg-light p-1 rounded">{{ price_handler(Auth::user()->wallet['balance'], $currency->value) }}</span>
        </div>

        <!-- Description -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="h5 not-background-p">{{ translating('wallet-page-ballance-description') }}</p>
        </div>
    </div>

    <!-- Title -->
    <h4 class="w-100 d-block my-3">{{ translating('charege-wallet-title') }}</h4>

    @if(isset($payment_methods) && count($payment_methods) > 0)
        <!-- Payment Methods Tab -->
        <ul class="nav nav-tabs" id="paymentsTab" role="tablist">
            <!-- Loop from payment methods -->
            @foreach($payment_methods as $payment_method)
                <!-- Tab -->
                <li class="nav-item">
                    <!-- Link -->
                    <a class="nav-link  @if($loop->first) active @endif" id="payment-method-{{ $payment_method->id }}-tab" data-toggle="tab" href="#payment-method-{{ $payment_method->id }}" role="tab" aria-controls="payment-method-{{ $payment_method->id }}"  aria-selected="@if($loop->first) true @endif">
                        <!-- Icon -->
                        <img width="120px" src="{{ asset($assets_path.'/img/payment-methods'.'/'.$payment_method->img) }}" class="responsive rounded" alt="{{ $payment_method->{'title_'.app()->getLocale()} }}">
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Payment Methods Tab Content -->
        <div class="tab-content" id="paymentsTabContent">
            <!-- Loop from payment methods -->
            @foreach($payment_methods as $payment_method)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="payment-method-{{ $payment_method->id }}" role="tabpanel" aria-labelledby="payment-method-{{ $payment_method->id }}-tab">
                    <!-- Title -->
                    <h3 class="font-weight-bold w-100 d-block my-3">{{ $payment_method->{'title_'.app()->getLocale()} }}</h3>

                    <!-- Online Payment -->
                    @if(isset($payment_method->option) && count($payment_method->option) > 0)
                        <div class="row">
                            <!-- Select Price -->
                            <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                                <select name="price" form="goToPayForm{{ $payment_method->type }}" class="input-default p-2 pl-3 pr-3 mt-2 mb-4 h5">
                                    <!-- Loop from options -->
                                    @foreach($payment_method->option as $option)
                                        <!-- Option -->
                                        <option value="{{ $option->id }}">{{ price_handler($option->price, $currency->value) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pay Button -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <!-- Form -->
                                <form id="goToPayForm{{ $payment_method->type }}" action="{{ route($payment_method->type.'PayOrder', ['locale' => app()->getLocale()]) }}" method="post" class="w-100 mt-2">
                                    @csrf
                                    <!-- Submit -->
                                    <button form="goToPayForm{{ $payment_method->type }}" type="submit" class="btn btn-main text-light btn-lg">{{ translating('pay-now') }}</button>
                                </form>
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <p class="h5 mt-2 not-background-p">{!! $payment_method->{'description_'.app()->getLocale()} !!}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
