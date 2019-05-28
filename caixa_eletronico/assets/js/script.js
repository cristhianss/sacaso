$(document).ready(function(){
    $("input[name*='valor']").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $.toast({
                heading: 'ALERTA',
                text: 'Apenas permitidos números ;)',
                showHideTransition: 'slide',
                icon: 'warning',
                position: 'top-right',
                stack: false,
                hideAfter: 5000
            });
            return false;
        }
    });

    $('input[name*=\'valor\']').on("cut copy paste",function(e) {
        e.preventDefault();
    });
    // function validateForms(){
    //     alert('rola');
    // }
    //
    // $("#form").submit(function(e) {
    //     var form = $('#form').val();
    //     alert(JSON.stringify(e));
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
    //         data: $("#form").serialize(),
    //         success: function (data) {
    //             $.toast({
    //                 heading: 'SUCESSO!',
    //                 text: 'Transação feita com sucesso ;)',
    //                 showHideTransition: 'slide',
    //                 icon: 'success',
    //                 position: 'top-right',
    //                 stack: false,
    //                 hideAfter: 5000
    //             });
    //         },
    //         error: function(e){
    //             alert(JSON.stringify(e));
    //         }
    //     });
    //
    // });

    // var frm = $('#form');
    //
    // frm.on("click", ":submit", function(e){
    //     console.log(frm);
    //     var jegy = $(this).attr('value');
    //     frm.push(jegy);
    //     console.log(frm);
    //
    //     $.ajax({
    //         type: frm.attr('method'),
    //         url: frm.attr('action'),
    //         data: frm.serialize(),
    //         success: function (data) {
    //             console.log('Submission was successful.');
    //             console.log(data);
    //         },
    //         error: function (data) {
    //             console.log('An error occurred.');
    //             console.log(data);
    //         },
    //     });
    //     e.preventDefault();
    // });

    $("#submitBtn").click(function(){
        alert('rola');
    });
});