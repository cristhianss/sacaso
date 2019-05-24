$(document).ready(function(){
    $("input[name*='valor']").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', affixesStay: false, allowZero: false, decimal: ','});

    // function validateForms(){
    //     alert('rola');
    // }
    //
    // $("#form").submit(function(e) {
    //
    //     var first_name = $('#currency1').val();
    //     var rola = document.getElementById('currency2');
    //     console.log(rola);
    //     var second_name = $('#currency2').val();
    //     console.log(first_name);
    //
    //
    //     //prevent Default functionality
    //     e.preventDefault();
    //
    //
    //     $(".error").remove();
    //     // if (first_name.length < 1) {
    //     //     $('#currency1').after('<span class="error">This field is required</span>');
    //     // }
    //     //
    //     // if (second_name.length < 1) {
    //     //     $('#currency2').after('<span class="error">This field is required</span>');
    //     // }
    //
    //     //get the action-url of the form
    //     var actionurl = e.currentTarget.action;
    //     console.log(actionurl);
    //
    //     //do your own request an handle the results
    //     $.ajax({
    //         url: actionurl,
    //         type: 'post',
    //         dataType: 'application/json',
    //         data: $("#form").serialize(),
    //         success: function(data) {
    //             alert('rola');
    //         }
    //     });
    //
    // });
});