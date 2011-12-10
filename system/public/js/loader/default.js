$(document).ready(function () {
    jQuery.fn.inputtoggle = function () {
        $(this).each(function () {
            var a = $(this).attr("value");
            $(this).focusin(function () {
                $(this).val() == a && $(this).val("");
            });
            $(this).focusout(function () {
                $(this).val() === "" && $(this).val(a);
            });
        });
    };
    $("a.tooltip").tipTip();
    $("ul.navigation ul").hide();
    $("ul.navigation li a").click(function () {
        $(this).parent().find("ul").slideToggle(100);
    });
    $("div#search-bar input").inputtoggle();
    $("div#search-bar input").keypress(function () {
        var a = $(this).val(),
            b = 0;
        $("ul.navigation li").each(function () {
            $(".buscaMenu").html("<h4 class='search'>Resultado(s) Encontrado(s): " + b + "</h4>");
            $(this).text().search(RegExp(a, "i")) < 0 ? $(this).fadeOut() : ($(this).show(), b++);
        });
    });
    $(".flashMessage").show(100).delay(6000).hide(100);
    $(".table").dataTable({
        sPaginationType: "full_numbers",
        sDom: '<"top"lf<"clear">>rt<"block-actions"ip>',
        oLanguage: {
            sLengthMenu: "Exibindo _MENU_ registro(s) por p\u00e1gina",
            sZeroRecords: "Nenhuma registro localizado",
            sLoadingRecords: "Por favor aguarde, carregando...",
            sSearch: "Busca:",
            sInfo: "P\u00e1gina _START_ de _END_ | Registro(s) localizado(s):  _TOTAL_ ",
            sInfoEmpty: "P\u00e1gina 0 de 0",
            sInfoFiltered: "de _MAX_",
            oPaginate: {
                sFirst: "Primeira P\u00e1gina",
                sLast: "\u00daltima P\u00e1gina",
                sNext: "Pr\u00f3xima",
                sPrevious: "Anterior"
            }
        }
    });
});