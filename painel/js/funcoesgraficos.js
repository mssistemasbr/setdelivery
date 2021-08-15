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

$(document).ready(function ($) {

});