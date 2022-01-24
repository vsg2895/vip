<div class="container-fluid">
{{--    <div class="row">--}}
        <!-- Calculator menu -->
        <div class="calculaor-menu mt-4 calculator-menu-contnet mobile-menu-bar-calc">
            <!-- Excange API Widget -->
            {{--                                <iframe id="rate-widget" scrolling="auto" frameborder="no" src="http://rate.am/informer/rate/iframe/Default.aspx?uid=UI-69030404&width=100%&height=250&cb=0&bgcolor=FFFFFF&lang=am" width="100%" height="250px"></iframe>--}}
                        <!--<table class="table table-sm table-striped table-bordered">-->
                        <!--    <thead>-->
                        <!--    <tr class="w-100 text-center">-->
                        <!--        <th>{{ translating('currency') }}</th>-->
                        <!--        <th>{{ translating('value') }}</th>-->
                        <!--    </tr>-->
                        <!--    </thead>-->
                        <!--    <tbody>-->
                        <!--    @foreach($currencies as $currency_value)-->
                        <!--        <tr class="w-100 text-center font-weight-bold">-->
                        <!--            <td class="valyutas_td mt-2">{{ $currency_value['simbol'] }}-->
                        <!--                <input-->
                        <!--                    type="text"-->
                        <!--                    form="currencyApiForm"-->
                        <!--                    name="{{ $currency_value->type }}"-->
                        <!--                    class="currency_1">-->
                        <!--            </td>-->
                        <!--            <td class="no-p-td"><p-->
                        <!--                    class="mt-2 no-p-td">{{ $currency_value['value'].' '.translating('amd') }}</p>-->
                        <!--            </td>-->
                        <!--        </tr>-->
                        <!--    @endforeach-->
                        <!--    </tbody>-->
                        <!--</table>-->

                                    @foreach($currencies as $currency_value)
                <div class="row-content-calc d-flex">
                    <div
                        class="col-6 valyutas_td mob-valyutas mt-1 align-items-center">
                        <input type="text" name="{{ $currency_value->type }}"
                               class="currency_1 w-100" form="currencyApiForm">
                    </div>
                    <div
                        class="col-5 font-weight-bold align-items-center valyuta_val">
                        {{ $currency_value['simbol'] }}
                        &nbsp; {{ $currency_value['value'] }} @if($currency_value->type != "amd") {{ translating('amd') }} @endif
                    </div>
                </div>

                @endforeach

        </form>


</div>
</div>
