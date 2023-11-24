// const trackerBtn = document.getElementById("tracker");

// function trackPackage() {
//   // Simulação de rastreamento com número aleatório
//   const trackingNumber = document.getElementById('trackingNumber').value;
//   const resultDiv = document.getElementById('result');
//   const SVGstatus = document.getElementById('status');

//   if (trackingNumber.trim() !== '') {

//   } else {

//   }
// }
//  trackerBtn.addEventListener('click', trackPackage);

document.getElementById('tracker').addEventListener('click', function () {
    // Obter o código da encomenda do input
    var codigoEncomenda = document.getElementById('trackingNumber').value;

    // Fazer a requisição AJAX para verificar o status da encomenda
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Atualizar o status da encomenda com a resposta do servidor
            atualizarStatusEncomenda(this.responseText);
        }
    };
    xhttp.open('POST', 'verificar_pedido.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('codigo_encomenda=' + codigoEncomenda);
});

function atualizarStatusEncomenda(status) {
    // Atualizar a interface com base no status retornado
    var divcol = document.getElementById('divcol');
    var trans = document.getElementById('trans');
    var ent = document.getElementById('ent');

    divcol.classList.remove('ativo');
    trans.classList.remove('ativo');
    ent.classList.remove('ativo');

    switch (status) {
        case 'Coletado':
            divcol.classList.add('ativo');
            break;
        case 'Transporte':
            trans.classList.add('ativo');
            break;
        case 'Entregue':
            ent.classList.add('ativo');
            break;
        default:
            // Tratar o caso em que o código não foi encontrado
            alert('Código de encomenda não encontrado.');
    }
}
