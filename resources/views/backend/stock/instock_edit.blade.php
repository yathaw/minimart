
<x-backend>
  
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Unique Shop's Stocks</h2>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="block">
            <div class="title"><strong>Edit Stock</strong></div>
            <ul class="app-breadcrumb breadcrumb side" style="margin-left:90%;">
                <a href="{{ route('product.index') }}" class="btn btn-outline-primary">
                    <i class="icofont-double-left icofont-1x"></i>
                </a>
            </ul>
            <div class="block-body">
                <form action="{{ route('instock.update',$stock->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="productid" value="{{ $stock->product->id }}">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Codeno</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $stock->product->codeno }}" disabled="">
                        </div>
                    </div>
                    <div class="line"></div>

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $stock->product->name }}" disabled="">
                        </div>
                    </div>
                    <div class="line"></div>

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Instock Qty</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="stock" value="{{ $stock->qty }}">
                        </div>
                    </div>
                 
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Expire Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="edate" value="{{ $stock->stockdate }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-9 ml-auto">
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-backend>
