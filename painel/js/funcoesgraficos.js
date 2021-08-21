function init_grafico_pizza_produtos(valorTotal, valorTotalHj) {
    if ("undefined" != typeof Chart && (console.log("init_grafico_pizza_produtos"), $(".graficoPizza_Produtos").length)) {
        var a = {
            type: "doughnut",
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
                labels: ["Total Produtos", "Produtos Hoje"],
                datasets: [{
                        data: [valorTotal, valorTotalHj],
                        backgroundColor: ["#26B99A", "#3498DB"],
                        hoverBackgroundColor: ["#36CAAB", "#49A9EA"]
                    }]
            },
            options: {
                legend: !1,
                responsive: !1
            }
        };
        $(".graficoPizza_Produtos").each(function () {
            var b = $(this);
            new Chart(b, a)
        })
    }
}

function init_grafico_pizza_usuarios(totalUsuario, totalUsuarioHj) {
    if ("undefined" != typeof Chart && (console.log("init_grafico_pizza_usuarios"), $(".graficoPizza_Usuarios").length)) {
        var a = {
            type: "doughnut",
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
                labels: ["Total Usuários", "Usuários Hoje"],
                datasets: [{
                        data: [totalUsuario, totalUsuarioHj],
                        backgroundColor: ["#26B99A", "#3498DB"],
                        hoverBackgroundColor: ["#36CAAB", "#49A9EA"]
                    }]
            },
            options: {
                legend: !1,
                responsive: !1
            }
        };
        $(".graficoPizza_Usuarios").each(function () {
            var b = $(this);
            new Chart(b, a)
        })
    }
}

function init_grafico_pizza_pedidos(totalPedidosHj) {
    if ("undefined" != typeof Chart && (console.log("init_grafico_pizza_pedidos"), $(".graficoPizza_Pedidos").length)) {
        var a = {
            type: "doughnut",
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
                labels: ["Total Pedidos"],
                datasets: [{
                        data: [totalPedidosHj],
                        backgroundColor: ["#3498DB"],
                        hoverBackgroundColor: ["#49A9EA"]
                    }]
            },
            options: {
                legend: !1,
                responsive: !1
            }
        };
        $(".graficoPizza_Pedidos").each(function () {
            var b = $(this);
            new Chart(b, a)
        })
    }
}

function inicia_grafico_barra(produto1, qtde1, produto2, qtde2, produto3, qtde3, produto4, qtde4, produto5, qtde5) {
    "undefined" != typeof Morris && (console.log("inicia_grafico_barra"), $("#grafico_barra").length && Morris.Bar({
        element: "grafico_barra",
        data: [{
                produto: produto1,
                quantidade: qtde1
            }, {
                produto: produto2,
                quantidade: qtde2
            },
            {
                produto: produto3,
                quantidade: qtde3
            },
            {
                produto: produto4,
                quantidade: qtde4
            },
            {
                produto: produto5,
                quantidade: qtde5
            }
        ],
        xkey: "produto",
        ykeys: ["quantidade"],
        labels: ["Quantidade"],
        barRatio: .4,
        barColors: ["#26B99A", "#34495E", "#ACADAC", "#3498DB"],
        xLabelAngle: 40,
        hideHover: "auto",
        resize: !0
    }));
}


$(document).ready(function ($) {

});