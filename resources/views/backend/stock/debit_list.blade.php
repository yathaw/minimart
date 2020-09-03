<x-backend>

  <div class="col-md-12">
    <div class="block margin-bottom-sm">
        <div class="title"><strong>Debit List Table</strong></div>
        <ul class="app-breadcrumb breadcrumb side"style="margin-left:90%;">
            <a href="{{ route('debit.create') }}" class="btn btn-outline-primary">
                <i class="icofont-plus icofont-1x"></i>
            </a>
        </ul>

        <div class="table-responsive"> 
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Codeno</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   @php $i=1; @endphp

                   @foreach($leftoverProducts as $leftoverProduct)

                   @php
                       $id = $leftoverProduct->id;
                       $codeno = $leftoverProduct->product->codeno;
                       $name = $leftoverProduct->product->name;

                       $qty = $leftoverProduct->qty;
                   @endphp
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$codeno}}</td>
                    <td>{{$name}}</td>
                    <td>{{$qty}}</td>

                    <td>

                        <form action="{{ route('debit.destroy',$id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-outline-danger" type="submit"> 
                                <i class="icofont-close icofont-1x"></i>
                            </button>

                        </form>
                    </td>

                </tr>
        @endforeach

    </tbody>
</table>
</div>
</div>
</div>
</x-backend>