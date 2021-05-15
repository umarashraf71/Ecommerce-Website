
//FUNCTION TO SEND CONTACT MESSAGE FROM FRONTEND
function send_message() {

    $(document).ready(function(){

    var name = $('#name').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    var message = $('#message').val();

    if(name == "") {

        alert('Please Enter Name !')
    }
    else if (email == "") {

        alert('Please Enter Email !')
    }
    else if (mobile == "") {

        alert('Please Enter Mobile Number !');
    }
    else if (message == "") {

        alert('Please Enter Message !')
    }
    else {

        jQuery.ajax({

            url:'ajax/send_message.php',
            type:'post',
            data:{
                name:name,
                email:email,
                mobile:mobile,
                message:message
            },
            success:function(result) {

                alert(result);
            }

        });

        $(document).ajaxStop(function() {
            
                location.reload();
            
        });

    }

    });

}



//FUNCTION TO REGISTER THE USER
function user_register() {

    $(document).ready(function(){

    $('.field_error').html('');    
    var name = $('#name').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    var password = $('#password').val();
    var is_error = '';    

    $('.field_error').css({"color":"red","font-size":"14px"});
    $('#reg_msg').css({"color":"green","font-size":"15px"});

    if(name == "") {

        $('#name_error').html('Please Enter Name !');
        is_error = 'yes';
    }
    if (email == "") {

        $('#email_error').html('Please Enter Email !');
        is_error = 'yes';
    }
    if (mobile == "") {

        $('#mobile_error').html('Please Enter Mobile Number !');
        is_error = 'yes';
    }
    if (password == "") {

        $('#password_error').html('Please Enter Password !');
        is_error = 'yes';
    }
    if(is_error == '') {

        jQuery.ajax({

            url:'ajax/register_submit.php',
            type:'post',
            data:{
                name:name,
                email:email,
                mobile:mobile,
                password:password
            },
            success:function(result) {

                if(result == "success") {

                    $('#reg_msg').html('User Registered Successfully !')

                    setInterval(function(){

                        location.reload();

                    },2500)

                }
                if(result == "email_error") {

                    $('#email_error').html('Email already exists !');
                }

            }

        });


    }

    });

}






//FUNCTION TO LOGIN THE USER
function user_login() {

    $(document).ready(function(){

    $('.field_error').html('');    
    var email = $('#login_email').val();
    var password = $('#login_password').val();
    var is_error = '';    

    $('.field_error').css({"color":"red","font-size":"14px"});
    $('#login_msg').css({"color":"red","font-size":"15px"});

  
    if (email == "") {

        $('#login_email_error').html('Please Enter Email !');
        is_error = 'yes';
    }
    if (password == "") {

        $('#login_password_error').html('Please Enter Password !');
        is_error = 'yes';
    }
    if(is_error == '') {

        jQuery.ajax({

            url:'ajax/login_submit.php',
            type:'post',
            data:{
                email:email,
                password:password
            },
            success:function(result) {

                if(result == "success") {

                    window.location.href = 'index.php';

                }
                if(result == "error") {

                    $('#login_msg').html('Invalid Email or Password !')
                }

            }

        });


    }

    });

}




//FUNCTION TO MANAGE CART
function manage_cart(product_id, type) {

        if(type=='update' || type=='remove') {

            var quantity = $('#'+product_id+'qty').val();

        }
        else {

            var quantity = $('#quantity').val();
        }

        jQuery.ajax({

            url:'ajax/manage_cart.php',
            type:'post',
            data:{
                product_id : product_id,
                quantity : quantity,
                type : type
            },
            success:function(result) {

                if(type=='remove' ) {

                    window.location.href=window.location.href;
                }

                if(type=='add') {

                    alert('Item Added to your Cart !');
                    window.location.href=window.location.href;
                }

                $('.htc__qua').html(result);

            }

        });

}




function minus_cart(productId) {

    //get product id from the product in cat.php file
    var productId = productId;

    //make the id which is used in the quantity input
    var id = productId+'qty';

    //Now get the value of quantity input
    var incQty = $('#'+id+'').val();

    //decrement the quantity by 1
    var incValue = parseInt(incQty) - 1;

    //if product quantity reaches to 1 then put 1 in the quantity input 
    //and call manage_cart function to update quantity in cart session array
    //after that get price of the product by unique id that we made and multiply that price
    //with 1 and store it in total variable and then display the total variable to the frontend 
    if(incValue <= 1) {

        $('#'+id+'').val(1);
        manage_cart(productId, type='update');

        var price = $('#'+productId+'-price').text();
        var total = parseInt(price) * parseInt(1);
        $('#'+productId+'-subtotal').text(total);
    }
    //if product quantity is greater than 1 then take the quantity input 
    //and call manage_cart function to update quantity in cart session array
    //after that get price of the product by unique id that we made and multiply that price
    //with the quantity and store it in total variable and then display the total variable to the frontend
    else {

        $('#'+id+'').val(incValue);
        manage_cart(productId, type='update');

        var price = $('#'+productId+'-price').text();
        var total = parseInt(price) * parseInt(incValue);
        $('#'+productId+'-subtotal').text(total);
    }


    //if value of quantity is greater than 0 then take the grandtotal from the frontend end
    //then take the price of the product and then subtract that price from the grandtotal 
    //then we will get the finalized total and we will then show that to frontend
    if(incValue > 0 )
    {
        var grandTotal = $('#grandTotal').text();
        var finalGrandTotal = parseInt(grandTotal) - parseInt(price);
        $('#grandTotal').text(finalGrandTotal);   
    }

}



//the plus_cart function has also the same functionalities as the minus_cart function the only difference
//is addition and subtraction
function plus_cart(productId) {

    var productId = productId;
    var id = productId+'qty';

    var incQty = $('#'+id+'').val();
    
    var incValue = parseInt(incQty) + 1;

    $('#'+id+'').val(incValue);
    manage_cart(productId, type='update');

    var price = $('#'+productId+'-price').text();
    var total = parseInt(price) * parseInt(incValue);
    $('#'+productId+'-subtotal').text(total);


    var grandTotal = $('#grandTotal').text();
    var finalGrandTotal = parseInt(grandTotal) + parseInt(price);
    $('#grandTotal').text(finalGrandTotal);

}






function sort_product_drop(cat_id) {

    var sort_product_id = $('#sort_product_id').val();

    window.location.href = "categories.php?id=" + cat_id + "&sort=" + sort_product_id + "";

}











