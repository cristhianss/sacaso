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

        $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results==null){
               return null;
            }
            else{
               return results[1] || 0;
            }
        }

        var loginParam = $.urlParam('login');
        if (loginParam === 'success'){
            $.toast({
                heading: 'SUCESSO!',
                text: 'Seja bem vindo!',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
                stack: false,
                hideAfter: 5000
            });
        } else {
            transactionAlert();
        }

        function transactionAlert(){
            var transactionParam = $.urlParam('transaction');
            if (transactionParam === 'success'){
                transactionSuccessAlert();
            } else if (transactionParam === 'limite') {
                transactionLimitErrorAlert();
            } else if (transactionParam === 'saldo_menor') {
                transactionSaldoErrorAlert();
            } else if (transactionParam === 'conta_obrigatoria') {
                transactionContaObrigatoriaErrorAlert();
            } else if (transactionParam === 'salario') {
                transactionSalarioErrorAlert();
            } else {
                console.log('deu ruim');
            }
        }

        function transactionSuccessAlert(){
            $.toast({
                heading: 'SUCESSO!',
                text: 'A transação foi feita com sucesso!',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
                stack: false,
                hideAfter: 5000
            });
        }

        function transactionErrorAlert(){
            $.toast({
                heading: 'ERRO',
                text: 'A transação não foi concluída.',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
                stack: false,
                hideAfter: 5000
            });
        }

        function transactionLimitErrorAlert(){
            $.toast({
                heading: 'ERRO',
                text: 'O limite de transação é de R$ 999,00',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
                stack: false,
                hideAfter: 5000
            });
        }

        function transactionSaldoErrorAlert(){
            $.toast({
                heading: 'ERRO',
                text: 'Valor de saque maior que o saldo atual!',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
                stack: false,
                hideAfter: 5000
            });
        }

        function transactionContaObrigatoriaErrorAlert(){
            $.toast({
                heading: 'ERRO',
                text: 'Selecione a conta para qual você deseja transferir!',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
                stack: false,
                hideAfter: 5000
            });
        }

        function transactionSalarioErrorAlert(){
            $.toast({
                heading: 'ERRO',
                text: 'Não permitida transferência para conta salário :(',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
                stack: false,
                hideAfter: 5000
            });
        }

        

        
        
        
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
    });