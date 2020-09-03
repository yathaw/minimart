<x-backend>


    <div class="page-header no-margin-bottom">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom"> Sales </h2>
        </div>
    </div>

    <section class="mt-3">
        <div class="container-fluid">
        	<div class="row" >	
        		<div class="col-md-7 col-sm-12">
        			<div class="block margin-bottom-sm">
        				<div class="row" id="searchMenu">     
                            @foreach($data[2] as $allproduct)

                                @php
                                $id=$allproduct->id;
                                $name = $allproduct->name;
                                $codeno = $allproduct->codeno;
                                $price = $allproduct->price;
                                $photo = $allproduct->photo;

                                @endphp
         

                                <div class="col-md-4 col-sm-6 col-6">
                                    <div class="card">
                                        <img src="{{ asset($photo) }}" class="card-img-top img-fluid" alt="..." style="height: 140px;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$name}}</h5>
                                                <p class="card-text">{{$price}}</p>
                                                <a href="javascript:void(0)"  class="btn btn-primary cart btn-block" data-id="{{$id}}" data-name="{{$name}}" data-codeno="{{$codeno}}" data-price="{{$price}}"
                                                data-photo="{{$photo}}">Add Bill</a>
                                            </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-sm-12 alert_action">
                    <div class="container">
                        <div class="row">
                            <div class="well col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{ asset('logo.png') }}" class="img-fluid">
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <address>
                                            <strong id="shopname"></strong>
                                            
                                            <strong id="address"></strong>
                                            <br>
                                            <abbr title="Phone" id="phone">P:</abbr> (+95)
                                        </address>
                                    </div>
                                    
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                        <p> <em id="date"></em> </p>
                                            <br>
                                        Receipt: <em id="voucherno"></em>
                                    </div>
                                </div>
            
                                <div class="row">
                                    <div class="text-center"> <h3>Receipt</h3> </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">SubTotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="voucherData"></tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2"> Grand Total </th>
                                                <th colspan="2"> <span id="grandtotals"> </span> </th>
                                            </tr>

                                            <tr>
                                                <th colspan="2"> Charges : </th>
                                                <th colspan="2"> <span id="chargetwo"> </span> </th>
                                            </tr>

                                            <tr>
                                                <th colspan="2"> Repay : </th>
                                                <th colspan="2"> <span id="repaytwo"> </span> </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>         
                            <button type="button" class="btn btn-primary btn-lg btn-block printBtn mt-3">
                                Print Now  <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-5" id="alert_hide" >

                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Product </th>
                                    <th> Qty </th>
                                    <th> Price </th>
                                    <th> Subtotal </th>
                                    <th> Remove </th>
                                </tr>
                            </thead>
                            <tbody id="list" ></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2"> Grand Total: </th>
                                    <th colspan="3"> 
                                        <input type="text" name="" id="shoppingcartTotal" readonly="readonly" class="form-control">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2"> Charges : </th>
                                    <th colspan="3"> 
                                        <input type="text" name="charge" id="charge" class="form-control">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2"> Repay : </th>
                                    <th colspan="3"> 
                                        <span id="repay"></span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <a href="javascript:void(0)" class="btn btn-primary checkoutBtn btn-block mt-3" data-name="<?php echo Auth::user()->shop->name?>" data-address="<?php echo Auth::user()->shop->address ?>" data-phone="<?php echo Auth::user()->phone ?>" > Check Out </a>

                </div>
            </div>
        </div>

    </section>
</x-backend>