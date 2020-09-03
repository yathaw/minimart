$(document).ready(function(){
    $('.alert_action').hide();
    showTable();

    var voucherno;
    function random(length){
      //alert("ok");

        var text = "";
        var possible = "123456789";
          
          for(var i = 0; i < length; i++) {
          
            text += possible.charAt(Math.floor(Math.random() * possible.length));
          
        }
          
          return text;

    }

    $('.selectCategory').click(function (){
        // var searchItem=$('#select option:selected').val();
        var searchItem = $(this).data('categoryid');

        console.log(searchItem);

        $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        url="/sale/"+searchItem;

        $.get(url,function(res){

            console.log(res.length > 0);

            if (res.length > 0) {

                var datatype=typeof(res);
                var data="";
                
                if(datatype=="object"){
                    data=res;
                }else{
                    data=JSON.parse(res);
                }
                var html="";
                $.each(data,function(i,v)
                {
                    var id=v.id;
                    var price=v.price; 
                    var codeno=v.codeno;
                    var name=v.name;
                    var photo=v.photo;

                    html+=`<div class="col-md-4" >
                                <div class="card">
                                    <img src="${photo}" class="card-img-top img-fluid" alt="..." style="height: 140px;">
                                    <div class="card-body">
                                        <h5 class="card-title">${name}</h5>
                                        <p class="card-text">${price}<p>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-block cart"
                                            data-id="${id}" data-name="${name}"
                                            data-codeno="${codeno}" data-price="${price}" 
                                            data-photo="${photo}">Add Bill</a>
                                    </div>
                                </div>
                            </div>`;
                });
                $('#searchMenu').html(html);
            }
            else{
                var html=`<div class="col-md-12">
                            <img src="no_products_found.png" class="img-fluid mx-auto d-block">
                        </div>`;

                $('#searchMenu').html(html);

            }
        });
    });
  

    $("#searchMenu").on('click','.cart',function(res){
        //alert("ok");

        var id= $(this).data('id');
        var name= $(this).data('name');
        var codeno=$(this).data('codeno');
        var photo=$(this).data('photo');
        var price=$(this).data('price');
        var qty=1;

        var mylist= {id:id,name:name,codeno:codeno,photo:photo,price:price,qty:qty};
        var cart=localStorage.getItem('cart');

        var cartArray;

        if(cart==null){
            cartArray = Array();
        }else{
            cartArray = JSON.parse(cart);
        }

        var status= false;

        $.each(cartArray ,function(i,v)
        {
            if(id==v.id){
                v.qty++;
                status=true;
            }
        });
        
        if(!status){
            cartArray.push(mylist);
        }
        var cartData= JSON.stringify(cartArray);
        localStorage.setItem("cart",cartData);
    
        showTable();

    });

    function showTable(){

        var cart = localStorage.getItem('cart');
        if(cart)
        {

            var cartArray = JSON.parse(cart);
            var shoppingcartData='';

            if(cartArray.length >-1){
                var total=0;

                $.each(cartArray, function(i,v){
                var id= v.id;
                var codeno = v.codeno;
                var name= v.name;
                var price= v.price;
                var photo= v.photo;
                var qty=v.qty;
                var price = price;
                var subtotal= price * qty;

                shoppingcartData += `<tr> 
                                        <td>${name}</td>
                                        <td> 
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-secondary plus_btn" data-id="${i}">
                                                    <i class="icofont-plus"></i> 
                                                </button>
                                                <button type="button" class="btn btn-secondary">${qty}</button>
                                                <button type="button" class="btn btn-secondary minus_btn" data-id="${i}">
                                                    <i class="icofont-minus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>${price} </td>
                                        <td>${subtotal}</td>
                                        <td>
                                            <button class="btn btn-outline-danger btn-sm remove" data-id="${i}">
                                                X
                                            </button>
                                        </td>
                                    </tr>`;
                total+=subtotal++;
            });
                $('#alert_hide').show();
                $('#list').html(shoppingcartData);
                $('#shoppingcartTotal').val(total + 'Ks');
            }
            else{
                $('#alert_hide').hide();
            }
        }
        else{
            $('#alert_hide').hide();
        }


        var repay=0;
        $('#charge').change(function(){
            var charges=$('#charge').val();
            repay=charges-total;

            $('#repay').text(repay + 'Ks');
        });

      }




    $('#list').on('click','.minus_btn',function ()
    { 
        var id=$(this).data('id');
        var cart=localStorage.getItem('cart');
        var cartArray=JSON.parse(cart);

        $.each(cartArray,function (i,v) {
            if (i==id){
                v.qty--;
                if(v.qty==0){
                    cartArray.splice(id,1);
                } 
            }
        })
        var cartData=JSON.stringify(cartArray);
        localStorage.setItem('cart',cartData);
        showTable();
    });

    $('#list').on('click','.plus_btn',function ()
    {

        var id=$(this).data('id');
        var cart=localStorage.getItem('cart');
        var cartArray=JSON.parse(cart);
        $.each(cartArray,function (i,v) {
            if (i==id){
                v.qty++;
            }
        })
        var cartData=JSON.stringify(cartArray);
        localStorage.setItem('cart',cartData);
        showTable();
    });


    $('#list').on('click','.remove',function (){

        var id=$(this).data('id');
        var cart=localStorage.getItem('cart');
        var cartArray=JSON.parse(cart);
        $.each(cartArray,function (i,v) {
            if (i==id){
                cartArray.splice(id,1);
            }
        })
    
        var cartData=JSON.stringify(cartArray);
        localStorage.setItem('cart',cartData);
        showTable();

        //location.reload();
    });


    $('.checkoutBtn').click(function (){
        $('.alert_action').show();
        $('#alert_hide').hide();
        
        var charges=$('#charge').val();
        var repay=$('#repay').val();
        var name=$(this).data("name");
        var address=$(this).data("address");
        var phone=$(this).data("phone");

        var cart = localStorage.getItem('cart');
        console.log(cart);
        
        if(cart){
            var cartArray = JSON.parse(cart);
            var voucherData='';

            if(cartArray.length >-1 )
            {
                var total=0;
                var repaytwo=0;
                voucherno=random(10);

                var date =  Date();
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = mm + '/' + dd + '/' + yyyy;

                $.each(cartArray, function(i,v){
                    var id= v.id;
                    var codeno = v.codeno;
                    var name= v.name;
                    var price= v.price;
                  
                    var photo= v.photo;
                    var qty=v.qty;
                    
                    var price = price;
                    var subtotal= price * qty;

                    voucherData += `<tr>
                                    <td class="col-md-9"><em>${name}</em></h4></td>
                                    <td class="col-md-1" style="text-align: center"> ${qty} </td>
                                    <td class="col-md-1 text-center">${price}</td>
                                    <td class="col-md-1 text-center">${subtotal}</td>
                                </tr>`;
                    total+=subtotal++;
                    repaytwo=charges-total;

                    $('#voucherData').html(voucherData);

                });
                
                $('#vouchertable').html(voucherData);
                $('#grandtotals').text(total + 'Ks');
                $('#repaytwo').text(repaytwo+ 'Ks');
                $('#chargetwo').text(charges+ 'Ks');
                $('#date').text('Date: '+today);
                $('#voucherno').text('UNI#'+voucherno);
                $('#shopname').text(name);
                $('#address').text(address);
                $('#phone').text(phone);
            }
        }

    });




    $('.printBtn').click(function(){
        var vcNum=voucherno;
        var cart=localStorage.getItem('cart');
      
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.post('/bills',{data:cart,vcNum:vcNum},function(response){
           localStorage.clear();
        });
    
    });




    $('.searchBtnn').change(function(){
        var searchItemm=$('#searchItemm').val();
        
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('/search',{product:searchItemm},function(response){

            var datatype=typeof(response);

            var table='';
            if(datatype=="object"){
                data=response;
            }else{
                data=JSON.parse(response);
            }
            var id= data["id"];
            var name= data["name"];
            var codeno=data["codeno"];
            var photo=data["photo"];
            var price=data["price"];
            var qty=1;

            var mylist= {id:id,name:name,codeno:codeno,photo:photo,price:price,qty:qty};
            console.log(id);

            var cart=localStorage.getItem('cart');

            var cartArray;

            if(cart==null){
                cartArray = Array();
            }
            else{
                cartArray = JSON.parse(cart);
            }

            var status= false;

            $.each(cartArray ,function(i,v)
            {
                if(id==v.id)
                {
                    v.qty++;
                    status=true;
                }
            });
            if(!status)
            {
                cartArray.push(mylist);

            }
            var cartData= JSON.stringify(cartArray);
            localStorage.setItem("cart",cartData);
    
            showTable();
        });
    });

});