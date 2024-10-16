@extends('layouts.master')
@section('title', 'Add Purchase Price')
@section('content')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Purchase Price Calculator</h4>
                <p>Prior to create resource, make sure asterisk signs are filled</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <select name="calculatorType" id="calculatorType" class="form-control">
                    <option value="" disabled selected>--Choose Your Calculatior--</option>
                    <option value="importer">Importer</option>
                    <option value="supplier">Supplier</option>
                </select>
            </div>
        </div>

        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="#" method="POST" id="supplier" style="display: none">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="japanPurchasePrice">Japan Purchase Price<span class="text-danger">
                                </span></label>
                            <div class="input-group">
                                <div class="input-group-text">¥</div>
                                <input type="number" id="japanPurchasePrice" placeholder="japan purchase price"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="japanTax">Japan Tax<span class="text-danger"> </span></label>
                            <div class="input-group">
                                <div class="input-group-text">¥</div>
                                <input type="number" id="japanTax" name="japanTax" placeholder="japan taxes"
                                    class="form-control">
                                <div class="input-group-text">.00</div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="yenToDollerRate">Yen to Doller Rate<span class="text-danger"> </span></label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" id="yenToDollerRate" placeholder="yen to doller rate"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="yenToDollerAmount">Yen to Doller Amount<span class="text-danger"> (Fill up by
                                    system)</span></label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" id="yenToDollerAmount" placeholder="yen to doller Amount"
                                    class="form-control">
                                <div class="input-group-text">.00</div>
                            </div>
                        </div>


                    </div>
                </form>

                <!-- Importer calculator Start !-->
                <form action="{{ route('merchant.vehicle.purchase-price.priceStore', ['vehicle' => $vehicle?->id]) }}"
                    method="POST" id="importer" style="display: none">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle?->id }}">
                    <div class="row">
                        <!-- LC part start !-->
                        <div class="col-lg-2 mb-3">
                            <label for="lcUSD">LC(USD)<span class="text-danger">
                                </span></label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" id="lcUSD" name="lc_usd" placeholder="LC amount in USD"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span class="fs-3">x</span>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label for="dollerRateLc">LC(USD Rate)<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" id="dollerRateLc" name="doller_ratelc"
                                    placeholder="Doller rate for LC" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span class="fs-2">=</span>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label for="lcTaka">LC(Taka)<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text">৳</div>
                                <input type="number" id="lcTaka" name="lc_taka" placeholder="LC money in Taka"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="lcDate">LC(Date)<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fa-solid fa-calendar-days"></i></div>
                                <input type="date" id="lcDate" name="lc_date" class="form-control">
                            </div>
                        </div>
                        {{-- <div class="col-lg-1"></div> --}}
                        <!-- LC part start !-->

                        <!-- TT part start !-->
                        <div class="col-lg-2 mb-3">
                            <label for="ttUSD">TT(USD)<span class="text-danger">
                                </span></label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" id="ttUSD" name="tt_usd" placeholder="TT amount in USD"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span class="fs-3">x</span>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label for="dollerRateTT">TT(USD Rate)<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" id="dollerRateTT" name="doller_ratett"
                                    placeholder="Doller rate for TT" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span class="fs-2">=</span>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label for="TTTaka">TT(Taka)<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text">৳</div>
                                <input type="number" id="TTTaka" name="tt_taka" placeholder="TT money in Taka"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="TTDate">TT(Date)<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fa-solid fa-calendar-days"></i></div>
                                <input type="date" id="TTDate" name="tt_date" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <!-- TT part End !-->

                        <!-- Total Purchase Price start !-->
                        <div class="col-lg-2 mb-3">
                            <label for="totalPurchasePriceUSD">Total Purchase Price(USD)<span class="text-danger">
                                </span></label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" id="totalPurchasePriceUSD" name="total_purchaseprice_usd"
                                    style="border:2px solid red" placeholder="Total purchase price USD"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span class="fs-3">x</span>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label for="totalPurchasePriceUSDRate">USD Rate<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" id="totalPurchasePriceUSDRate" name="total_purchase_priceUSDRate"
                                    style="border:2px solid red" placeholder="Doller rate for purchase"
                                    class="form-control" step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span class="fs-2">=</span>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label for="totalTaka">Total(Taka)<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text">৳</div>
                                <input type="number" id="totalTaka" name="total_taka" placeholder="Total money in Taka"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4 text-center">
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="purchaseDate">Purchase Date<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fa-solid fa-calendar-days"></i></div>
                                <input type="date" id="purchaseDate" name="purchase_date" class="form-control">
                            </div>
                        </div>
                        <!-- Total Purchase Price End !-->

                        <!-- Port Charge Start !-->
                        <div class="col-lg-5"></div>
                        <div class="col-lg-1 text-center mt-4 fs-2">+</div>
                        <div class="col-lg-2 mb-3">
                            <label for="portCharge">Port Charge<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text" id="portDownArrow"><i
                                        class="fa-solid fa-arrow-down-a-z"></i></div>
                                <input type="number" id="portCharge" name="port_charge" class="form-control"
                                    style="border:2px solid red" placeholder="Port Charge">
                                <div class="input-group-text">৳</div>

                                <!-- Sub port charge start !-->
                                <div class="row ms-2 mt-3 border border-slate-400 p-2 rounded" id="subPortCharge"
                                    style="display: none">
                                    <div class="col-lg-12 mb-1">
                                        <label for="portLandDate">Landing Date at Port</label>
                                        <input type="date" id="portLandDate" name="port_landDate"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-12 mb-1">
                                        <label for="portDailyCharge">Daily Charge</label>
                                        <input type="text" id="portDailyCharge" name="port_dailyCharge"
                                            class="form-control" placeholder="Daily Charge">
                                    </div>
                                    <div class="col-lg-12 mb-1">
                                        <label for="portExitDate">Exit Date from Port</label>
                                        <input type="date" id="portExitDate" name="port_exitDate"
                                            class="form-control">
                                    </div>
                                </div>
                                <!-- Sub port charge End !-->
                            </div>
                        </div>

                        <div class="col-lg-1"></div>
                        <div class="col-lg-3" style="position: relative">
                            <div class="row p-2"
                                style="position: absolute;top:0;left:0;border:8px solid gray;border-radius:5px">
                                <!-- Total Costing Start !-->
                                <div class="col-lg-12">
                                    <label for="totalCosting">Total Costing<span class="text-danger"></span></label>
                                    <div class="input-group">
                                        <div class="input-group-text">৳</div>
                                        <input type="number" id="totalCosting" name="total_costing"
                                            class="form-control" placeholder="Total Costing"
                                            style="font-size: 18px;font-weight:700" readonly>
                                    </div>
                                </div>
                                <!-- Total Costing End !-->

                                <!-- Add Profit Start !-->
                                <div class="col-lg-12">
                                    <label for="addProfit">Add Profit<span class="text-danger"></span></label>
                                    <div class="input-group">
                                        <div class="input-group-text">৳</div>
                                        <input type="number" id="addProfit" name="add_profit" class="form-control"
                                            style="border:2px solid red" placeholder="Porfit">
                                    </div>
                                </div>
                                <!-- Add Profit End !-->

                                <!-- Total Selling Price Start !-->
                                <div class="col-lg-12">
                                    <label for="sellingPrice">Total Selling Price(Asking Price/Negotiable)<span
                                            class="text-danger"></span></label>
                                    <div class="input-group">
                                        <div class="input-group-text">৳</div>
                                        <input type="number" id="sellingPrice" name="selling_price"
                                            class="form-control" style="font-size: 18px;font-weight:700"
                                            placeholder="Selling Price" readonly>
                                    </div>
                                </div>
                                <!-- Total Selling Price End !-->
                            </div>

                        </div>

                        <!--Port Charge End !-->

                        <!-- Add Expenses Start !-->
                        <div class="col-lg-5"></div>
                        <div class="col-lg-1 text-center mt-4 fs-2">+</div>
                        <div class="col-lg-2 mb-3">
                            <label for="addExpenses">Add Expenses<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text" id="expensesDownArrow"><i
                                        class="fa-solid fa-arrow-down-a-z"></i>
                                </div>
                                <input type="number" id="addExpenses" name="add_expenses" class="form-control"
                                    style="border:2px solid red" placeholder="Add Expenses">
                                <div class="input-group-text">৳</div>

                                <!-- Sub add expenses start !-->
                                <div class="row ms-2 mt-3 border border-slate-400 p-2 rounded" id="subAddExpenses"
                                    style="display: none">
                                    <div class="col-lg-12 mb-1">
                                        <label for="transportationCost">Transportaion Cost</label>
                                        <input type="number" id="transportationCost" name="transportation_cost"
                                            class="form-control" placeholder="Transportation Cost">
                                    </div>
                                    <div class="col-lg-12 mb-1">
                                        <label for="touchUp">Touch up Cost</label>
                                        <input type="number" id="touchUp" name="touch_up" class="form-control"
                                            placeholder="Touch Up">
                                    </div>
                                    <div class="col-lg-12 mb-1">
                                        <label for="parseAccessoy">Parse and Excessories</label>
                                        <input type="number" id="parseAccessoy" name="parse_accessoy"
                                            class="form-control" placeholder="Parse and Excessory">
                                    </div>
                                    <div class="col-lg-12 mb-1">
                                        <label for="speedMoney">Speed Money</label>
                                        <input type="number" id="speedMoney" name="speed_money" class="form-control"
                                            placeholder="Speed Money">
                                    </div>
                                    <div class="col-lg-12 mb-1">
                                        <label for="others">Others</label>
                                        <input type="number" id="others" name="others" class="form-control"
                                            placeholder="Others">
                                    </div>
                                </div>
                                <!-- Sub add expenses End !-->
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <!--Add Expenses End !-->

                        <!-- CNF Charge Start !-->
                        <div class="col-lg-5"></div>
                        <div class="col-lg-1 text-center mt-3 fs-2">+</div>
                        <div class="col-lg-2 mb-3">
                            <label for="CNFCharge">CNF Charge<span class="text-danger"></span></label>
                            <div class="input-group">
                                <div class="input-group-text">৳</div>
                                <input type="number" id="CNFCharge" name="cnf_charge" class="form-control"
                                    style="border:2px solid red" placeholder="CNF Charge">
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <!--CNF Charge End !-->
                    </div>
                    <hr>
                    <!-- Terms and condition for fixed price start !-->
                    <div class="row d-flex justify-content-end">
                        <div class="col-lg-3">
                            <label for="fixed_price" class="text-danger">Fixed Price for Pilot Bazar</label>
                            <div class="input-group">
                                <div class="input-group-text">৳</div>
                                <input type="number" placeholder="Fixed Price" name="fixed_price" class="form-control"
                                    style="font-size: 18px;font-weight:700">
                            </div>
                            <p class="text-danger">
                                @error('fixed_price')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <p class="fs-5">এই গাড়ী আমার Import করা। Auction Sheet Original এবং
                                আমি চাই Pilot Bazar Automobiles আমার হয়ে গাড়িটি বিক্রি করুক.
                            </p>
                            <p class="text-danger">
                                @error('terms_agree')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="col-lg-2 mt-1">
                            <input type="radio" name="terms_agree" value="yes" id="termsAgree">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <p class="fs-5">এই গাড়ীটি আমার নয়। এটা ডিলারের গাড়ী / অন্যের গাড়ী। Auction Sheet Original নয়।
                                গাড়ীটি শুধু মাত্র আমার পেজই এ থাকবে।</p>
                            <p class="text-danger">
                                @error('terms_agree')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="col-lg-2 mt-1">
                            <input type="radio" name="terms_agree" value="no" id="termsAgree">
                        </div>
                    </div>
                    <hr>
                    <!-- Terms and condition for fixed price End !-->
                    <div class="row d-flex justify-content-end" style="box-sizing:border-box">
                        <div class="col-lg-2" style="box-sizing:border-box">
                            <button type="submit"
                                class="px-5 py-1 bg-success text-white border border-slate-400 rounded">Save</button>
                        </div>
                    </div>

                </form>
                <!-- Importer calculator End !-->
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let calculatorType = document.querySelector('#calculatorType'),
            supplier = document.querySelector('#supplier'),
            importer = document.querySelector('#importer'),

            // PortDownArrow
            portDownArrow = document.querySelector('#portDownArrow'),
            subPortCharge = document.querySelector('#subPortCharge'),

            // expensesDownArrow
            expensesDownArrow = document.querySelector('#expensesDownArrow'),
            subAddExpenses = document.querySelector('#subAddExpenses'),


            japanPurchasePrice = document.querySelector('#japanPurchasePrice'),
            japanTax = document.querySelector('#japanTax'),
            yenToDollerRate = document.querySelector('#yenToDollerRate'),
            yenToDollerAmount = document.querySelector('#yenToDollerAmount');


        // Input fields value:
        let lcUSD = document.querySelector('#lcUSD'),
            dollerRateLc = document.querySelector('#dollerRateLc'),
            lcTaka = document.querySelector('#lcTaka'),
            lcDate = document.querySelector('#lcDate'),
            ttUSD = document.querySelector('#ttUSD'),
            dollerRateTT = document.querySelector('#dollerRateTT'),
            TTTaka = document.querySelector('#TTTaka'),
            TTDate = document.querySelector('#TTDate'),
            totalPurchasePriceUSD = document.querySelector('#totalPurchasePriceUSD'),
            totalPurchasePriceUSDRate = document.querySelector('#totalPurchasePriceUSDRate'),
            totalTaka = document.querySelector('#totalTaka'),
            purchaseDate = document.querySelector('#purchaseDate'),
            portCharge = document.querySelector('#portCharge'),
            portDailyCharge = document.querySelector('#portDailyCharge'),
            portLandDate = document.querySelector('#portLandDate'),
            addProfit = document.querySelector('#addProfit'),
            CNFCharge = document.querySelector('#CNFCharge'),
            totalCosting = document.querySelector('#totalCosting'),
            sellingPrice = document.querySelector('#sellingPrice'),
            addExpenses = document.querySelector('#addExpenses'),
            transportationCost = document.querySelector('#transportationCost'),
            touchUp = document.querySelector('#touchUp'),
            parseAccessoy = document.querySelector('#parseAccessoy'),
            speedMoney = document.querySelector('#speedMoney'),
            others = document.querySelector('#others');

        // Global variable:
        var lcTakaValue = 0;
        var TTTakaValue = 0
        var totalTakaValue = 0;
        var totalPurchasePriceUSDValue = 0;
        var totalPurchasePriceUSDRateValue = 0;
        var totalCostValue = 0;

        const lcAndTTElements = [lcUSD, ttUSD, dollerRateLc, dollerRateTT];
        const totalPurchaseUsdToTakaElement = [totalPurchasePriceUSD, totalPurchasePriceUSDRate];
        const totalCostCalculationElement = [...lcAndTTElements, totalPurchasePriceUSD, totalPurchasePriceUSDRate,
            portCharge,
            portDailyCharge,
            addExpenses,
            CNFCharge,
            addProfit,
            transportationCost,
            touchUp,
            parseAccessoy,
            speedMoney,
            others

        ];
        const addExpensesElements = [
            transportationCost, touchUp, parseAccessoy, speedMoney, others
        ];
        /*Variable declaration End*/

        /* Selecting calculator and save it into localstorage*/
        calculatorType.addEventListener('change', function() {
            localStorage.setItem('type', calculatorType.value);
            updateDisplay();
        });

        function updateDisplay() {
            const storedType = localStorage.getItem('type');
            if (storedType) {
                calculatorType.value = storedType;
            }
            if (storedType === 'importer') {
                importer.style.display = 'block';
                supplier.style.display = 'none';
            } else if (storedType === 'supplier') {
                supplier.style.display = 'block';
                importer.style.display = 'none';
            }
        }

        // When the page is fully loaded, apply the stored type settings
        document.addEventListener('DOMContentLoaded', function() {
            updateDisplay();
        });

        // Lc and TT calcuation
        lcAndTTElements.forEach(function(element) {
            // Calculation of lcUSD to Taka.
            element.addEventListener('keyup', function() {
                lcTakaValue = Number(lcUSD.value) * Number(dollerRateLc.value);
                lcTaka.value = lcTakaValue;
            });

            // Calculate of TTUSD to Taka.
            element.addEventListener('keyup', function() {
                TTTakaValue = Number(ttUSD.value) * Number(dollerRateTT.value);
                TTTaka.value = TTTakaValue;
            });

            // Taka total by LC an TT.
            element.addEventListener("keyup", function() {
                totalTakaValue = lcTakaValue + TTTakaValue;
                totalTaka.value = totalTakaValue;

            });

            // total USD by LCUSE AND TTUSD Concate
            element.addEventListener('keyup', function() {
                totalPurchasePriceUSDValue = Number(lcUSD.value) + Number(ttUSD.value);
                totalPurchasePriceUSD.value = totalPurchasePriceUSDValue;
                totalPurchasePriceUSDRateValue = (totalTakaValue / totalPurchasePriceUSDValue).toFixed(2);
                totalPurchasePriceUSDRate.value = totalPurchasePriceUSDRateValue;
            });
        })

        //Total purchase price USD To Taka (when keyup ==> totalPurchasePriceUSD,totalPurchasePriceUSDRate)
        totalPurchaseUsdToTakaElement.forEach(function(element) {
            element.addEventListener('keyup', function() {
                totalTaka.value = Number(totalPurchasePriceUSD.value) * Number(totalPurchasePriceUSDRate
                    .value);
                let newlcAndTTElements = [...lcAndTTElements, lcTaka, TTTaka];
                newlcAndTTElements.forEach(function(element) {
                    element.value = 0;
                })
            });
        });

        // portCharge calculation
        portDailyCharge.addEventListener('keyup', function() {
            portCharge.value = Number(portDailyCharge.value);
        });

        // Add expenses calculation
        addExpensesElements.forEach(function(element) {
            element.addEventListener('keyup', function() {
                addExpenses.value = Number(transportationCost.value) + Number(touchUp.value) + Number(
                    parseAccessoy.value) + Number(speedMoney.value) + Number(others.value);
            })
        });

        // total Cost Calculation.
        totalCostCalculationElement.forEach(function(element) {
            element.addEventListener('keyup', function() {
                totalCostValue = Number(totalTaka.value) + Number(portCharge.value) + Number(CNFCharge
                    .value) + Number(addExpenses.value);
                totalCosting.value = totalCostValue;
                sellingPrice.value = Number(totalCostValue) + Number(addProfit.value);
            })
        })

        // PortDownArrow --> Open subPortCharge Box.
        portDownArrow.addEventListener('click', function() {
            if (subPortCharge.style.display == 'none') {
                subPortCharge.style.display = 'block';
            } else {
                subPortCharge.style.display = 'none';
            }

        });

        // expensesDownArrow --> Open subAddExpenses Box.
        expensesDownArrow.addEventListener('click', function() {
            if (subAddExpenses.style.display == 'none') {
                subAddExpenses.style.display = 'block';
            } else {
                subAddExpenses.style.display = 'none';
            }

        });

        yenToDollerRate.addEventListener('keyup', function(e) {
            let yenToDollerValue = (Number(japanPurchasePrice.value) + Number(japanTax.value)) * Number(e.target
                .value);
            yenToDollerAmount.value = yenToDollerValue;
        });
    </script>
@endpush
