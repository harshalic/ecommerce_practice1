$(document).ready(function(){
$("#response").hide();
$("#order_microsoft").hide();
$("#order_mcafee").hide();
 $("#result").hide();
 $("#micro_button").hide();
 $("#mcafee_button").hide();
$("img").hover(
    function(){
        $(this).addClass("mouseover");
        
},
    function(){
        $(this).removeClass("mouseover");  
    }    
            );
    
$("#button").click(function(){
    $("#response").toggle();
})  ;


$('#micro_form').submit(function(e){
                       e.preventDefault();
                       var params={
                         'submit'  :"Calculate for microsoft"
                       };
                        data=$(this).serialize()+"&"+$.param(params);
                        console.log(data);
                        var month=data[6]+data[7];
                        if(month=="02"){
                        ajax_call('integrate.php',data,"#response"); 
                        }
                       else{
                            alert("select date from present month");
                        }
                       $("#micro_button").show();
                    //$("#order_microsoft").show();
                        
         });
 $('#micro_button').bind('click', function(e) {

        e.preventDefault();
        $("#order_microsoft").bPopup();
        $("#a_tag").show();        
                
});        
$('#mcafee_form').submit(function(e){
                       e.preventDefault();
                       var params={
                         'submit'  :"Calculate for mcafee"
                       };
                        data=$(this).serialize()+"&"+$.param(params);
                        console.log(data);
                        var month=data[6]+data[7];
                        if(month=="02"){
                            ajax_call('integrate.php',data,"#response"); 
                        }
                       else{
                            alert("select date from present month");
                        }
                        $("#mcafee_button").show();
                        
         });        
 $('#mcafee_button').bind('click', function(e) {

        e.preventDefault();
        $("#order_mcafee").bPopup();
        $("#a_tag").show();        
                
});
$('#order_microsoft').submit(function(e){
                       e.preventDefault();
                       var params={
                         'submit'  :"order microsoft"
                       };
                        data=$(this).serialize()+"&"+$.param(params);
                        //console.log(data);

                        ajax_call('integrate.php',data,"#order_microsoft"); 
                        
                        
                        
         });

$('#order_mcafee').submit(function(e){
                       e.preventDefault();
                       var params={
                         'submit'  :"order mcafee"
                       };
                        data=$(this).serialize()+"&"+$.param(params);
                        //console.log(data);

                        ajax_call('integrate.php',data,"#order_mcafee"); 
         });

function ajax_call (action,data,display){
        
  $.ajax({ url: action, 
            type: 'post', 
            data: data,
           //dataType: 'json',
            success:function( reply ){
                
               var xyz= $(display).html(reply,display);
               ready_form(xyz,reply);
            }, 
            error:function( errorThrown ){ 
                console.log( errorThrown ); 
                }
            });
}

function ready_form(data,reply){
     
 var str = data[0].innerText;
 
 var pos = str.indexOf("Rs. ");
 var price=str.substring(pos+4,pos+12);
 var pos_dot = price.indexOf(".");
  price=price.substring(0,pos_dot+3);
 $(".price").val(price);
 
           /* $(display).text(reply);
            $(display).bPopup({
            speed: 650,
            transition: 'slideIn',
	    transitionClose: 'slideBack'
        });*/
 
}





});