document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("tracker").addEventListener("click", function (event) {
      event.preventDefault();
      var trackingNumber = document.getElementById("trackingNumber").value;
  
      // Enviar requisição AJAX para o arquivo PHP
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "index.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var statusEntrega = document.getElementById("status-entrega");
          var statusValue = xhr.responseText;
  
          // Verificar se a tag <p> existe
          if (statusEntrega) {
            // Remover todas as classes existentes
            statusEntrega.classList.remove("status-coletado", "status-transporte", "status-entregue", "status-nao-encontrado");
  
            // Adicionar a classe correspondente ao valor retornado
            switch (statusValue) {
              case "0":
                statusEntrega.textContent = "Código de rastreamento não encontrado.";
                statusEntrega.classList.add("status-nao-encontrado");
                break;
              case "1":
                statusEntrega.textContent = "Pedido coletado";
                statusEntrega.classList.add("status-coletado");
                break;
              case "2":
                statusEntrega.textContent = "Pedido em transporte";
                statusEntrega.classList.add("status-transporte");
                break;
              case "3":
                statusEntrega.textContent = "Pedido entregue";
                statusEntrega.classList.add("status-entregue");
                break;
              default:
                statusEntrega.textContent = "Status desconhecido";
            }
          }
        }
      };
      xhr.send("trackingNumber=" + trackingNumber);
    });
  });
  