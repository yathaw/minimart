
<x-backend>
  
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <h2 class="h5 no-margin-bottom">Unique Shop's Product Detail</h2>
                </div>
                <div class="col-2">
                    <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-double-left icofont-1x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="block">
            <div class="title"><strong>Product Detail</strong></div>
            
            <div class="block-body">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset($product->photo) }}" class="img-fluid">
                    </div>
                    <div class="col-9">
                        <span class="d-block my-2"> <b> Codeno : </b> {{ $product->codeno }}</span> 
                        <span class="d-block my-2"> <b> Name : </b> {{ $product->name }}</span> 
                        <span class="d-block my-2"> <b> Category : </b> {{ $product->category->name }}</span> 

                        <span class="d-block mt-4"> <b> Supplier : </b> {{ $product->brand->name }}</span> 
                        <span class="d-block my-2"> <b> Price : </b> {{ $product->price }}</span>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="title"><strong>Stock List</strong></div>
                    </div>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Stock Date </th>
                                        <th> Qty </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i=1;

                                    @endphp


                                    @if($stocks)
                                    @foreach($stocks as $stock)

                                    @php
                                       $id = $stock->id;
                                       $stockdate = $stock->stockdate;
                                       $qty = $stock->qty;
                                       $status = $stock->status;
                                    @endphp

                                    <tr>
                                        <td scope="row">{{$i++}}</td>
                                        <td> {{ $stockdate }} </td>
                                        <td> {{ $qty }} </td>
                                        <td> {{ $status }} </td>
                                        <td> 
                                            <a href="{{ route('instock.edit',$id) }}" class="btn btn-outline-warning">
                                                <i class="icofont-ui-settings icofont-1x"></i>
                                            </a>
                                        </td>


                                    </tr>

                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-backend>
