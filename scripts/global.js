// jQuery.noConflict()(function ($) {
//     $(document).ready(init());
// });

function callPHP(funct)
{
    console.log("Calling php." + funct + "()...");
    jQuery.ajax(
    {
        url: 'callPHP.php',
        type: 'POST',
        data: 'funct=' + funct
     }).done(function(data){
            console.log(JSON.stringify(data));
    });
}

// function destroySession(){
//   var theForm = $("#yourForm");
//   //we don't need any ajax frame.
//   theForm.each(function(){ this.reset() });
//   $.ajax({
//     url: 'destroysession.php',
//     type: 'post',
//     data: 'sure=1', //send a value to make sure we want to destroy it.
//     success: function(data);
//       alert(data);
//     }
//   });
// }
