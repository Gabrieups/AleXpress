<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/styles.css">
  <link rel="icon" href="src/imagens/Aicon.png">
  <title>Rastreamento de Encomendas</title>
</head>
<body>
  <div class="container">
    <div class="cabecalho">
      <img src="src/imagens/alexpress.png" alt="AleXpress logo">
    </div>

    <form class="busca" action="index.php" method="post">
     <input type="text" id="trackingNumber" name="trackingNumber" placeholder="Digite o número de rastreamento">
     <button type="submit" id="tracker"><img src="src/imagens/rastrear.png" alt="Rastrear"></button>
    </form>
<?php
error_reporting(0);
// Conectar ao banco de dados MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pedidodb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter o código de rastreamento do formulário
$trackingNumber = $_POST['trackingNumber'];

// Consultar o banco de dados para verificar se o código está presente
$query = "SELECT * FROM encomendas WHERE codigo = '$trackingNumber'";
$result = $conn->query($query);

// ... (seu código PHP anterior)

if ($result->num_rows > 0) {
  // Código encontrado, obter o status
  $status = $result->fetch_assoc()['status'];

  // Retornar o valor correspondente ao status
  if ($status == "Pedido coletado") {
      echo "<div class='status' id='divcol'> 
              <svg class='pedimg' id='pedcol' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
              <path d='M7.50626 15.2647C7.61657 15.6639 8.02965 15.8982 8.4289 15.7879C8.82816 15.6776 9.06241 15.2645 8.9521 14.8652L7.50626 15.2647ZM6.07692 7.27442L6.79984 7.0747V7.0747L6.07692 7.27442ZM4.7037 5.91995L4.50319 6.64265L4.7037 5.91995ZM3.20051 4.72457C2.80138 4.61383 2.38804 4.84762 2.2773 5.24675C2.16656 5.64589 2.40035 6.05923 2.79949 6.16997L3.20051 4.72457ZM20.1886 15.7254C20.5895 15.6213 20.8301 15.2118 20.7259 14.8109C20.6217 14.41 20.2123 14.1695 19.8114 14.2737L20.1886 15.7254ZM10.1978 17.5588C10.5074 18.6795 9.82778 19.8618 8.62389 20.1747L9.00118 21.6265C10.9782 21.1127 12.1863 19.1239 11.6436 17.1594L10.1978 17.5588ZM8.62389 20.1747C7.41216 20.4896 6.19622 19.7863 5.88401 18.6562L4.43817 19.0556C4.97829 21.0107 7.03196 22.1383 9.00118 21.6265L8.62389 20.1747ZM5.88401 18.6562C5.57441 17.5355 6.254 16.3532 7.4579 16.0403L7.08061 14.5885C5.10356 15.1023 3.89544 17.0911 4.43817 19.0556L5.88401 18.6562ZM7.4579 16.0403C8.66962 15.7254 9.88556 16.4287 10.1978 17.5588L11.6436 17.1594C11.1035 15.2043 9.04982 14.0768 7.08061 14.5885L7.4579 16.0403ZM8.9521 14.8652L6.79984 7.0747L5.354 7.47414L7.50626 15.2647L8.9521 14.8652ZM4.90421 5.19725L3.20051 4.72457L2.79949 6.16997L4.50319 6.64265L4.90421 5.19725ZM6.79984 7.0747C6.54671 6.15847 5.8211 5.45164 4.90421 5.19725L4.50319 6.64265C4.92878 6.76073 5.24573 7.08223 5.354 7.47414L6.79984 7.0747ZM11.1093 18.085L20.1886 15.7254L19.8114 14.2737L10.732 16.6332L11.1093 18.085Z' fill='#032CA6'/>
              <path d='M19.1647 6.2358C18.6797 4.48023 18.4372 3.60244 17.7242 3.20319C17.0113 2.80394 16.1062 3.03915 14.2962 3.50955L12.3763 4.00849C10.5662 4.47889 9.66119 4.71409 9.24954 5.40562C8.8379 6.09714 9.0804 6.97492 9.56541 8.73049L10.0798 10.5926C10.5648 12.3481 10.8073 13.2259 11.5203 13.6252C12.2333 14.0244 13.1384 13.7892 14.9484 13.3188L16.8683 12.8199C18.6784 12.3495 19.5834 12.1143 19.995 11.4227C20.2212 11.0429 20.2499 10.6069 20.1495 10' stroke='#032CA6' stroke-width='1' stroke-linecap='round'/>
              </svg>
              <p>Pedido Coletado</p>
            </div>";
  } elseif ($status == "Pedido em transporte") {
      echo "<div class='status' id='trans'>
              <svg class='pedimg' id='pedtrans' viewBox='0 0 64 64' xmlns='http://www.w3.org/2000/svg' stroke-width='2' stroke='#032CA6' fill='none'>
                <path d='M21.68,42.22H37.17a1.68,1.68,0,0,0,1.68-1.68L44.7,19.12A1.68,1.68,0,0,0,43,17.44H17.61a1.69,1.69,0,0,0-1.69,1.68l-5,21.42a1.68,1.68,0,0,0,1.68,1.68h2.18'/>
                <path d='M41.66,42.22H38.19l5-17.29h8.22a.85.85,0,0,1,.65.3l3.58,6.3a.81.81,0,0,1,.2.53L52.51,42.22h-3.6'/>
                <ellipse cx='18.31' cy='43.31' rx='3.71' ry='3.76'/>
                <ellipse cx='45.35' cy='43.31' rx='3.71' ry='3.76'/>
                <line x1='23.25' y1='22.36' x2='6.87' y2='22.36' stroke-linecap='round'/>
                <line x1='20.02' y1='27.6' x2='8.45' y2='27.6' stroke-linecap='round'/>
                <line x1='21.19' y1='33.5' x2='3.21' y2='33.5' stroke-linecap='round'/>
              </svg>
              <p>Pedido em Transporte</p>
            </div>";
  } elseif ($status == "Pedido entregue") {
      echo "<div class='status' id='ent'>
              <svg class='pedimg' id='pedent' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <path d='M11.0287 2.53961C11.6327 2.20402 12.3672 2.20402 12.9713 2.5396L20.4856 6.71425C20.8031 6.89062 21 7.22524 21 7.5884V15.8232C21 16.5495 20.6062 17.2188 19.9713 17.5715L12.9713 21.4604C12.3672 21.796 11.6327 21.796 11.0287 21.4604L4.02871 17.5715C3.39378 17.2188 3 16.5495 3 15.8232V7.5884C3 7.22524 3.19689 6.89062 3.51436 6.71425L11.0287 2.53961Z' stroke='#032CA6' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
                <path d='M3 7L12 12M12 12L21 7M12 12V22' stroke='#032CA6' stroke-width='1' stroke-linejoin='round'/>
                <path d='M7.5 9.5L16.5 4.5' stroke='#032CA6' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
                <path d='M6 12.3281L9 14' stroke='#032CA6' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
              </svg>
              <p>Pedido Entregue</p>
            </div>";
  }
} 

$conn->close();
?>
    <div class="rodape"></div>
  </div>
  <script src="src/script.js"></script>
</body>
</html>
