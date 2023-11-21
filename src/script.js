const trackerBtn = document.getElementById("tracker");

function trackPackage() {
  // Simulação de rastreamento com número aleatório
  const trackingNumber = document.getElementById('trackingNumber').value;
  const resultDiv = document.getElementById('result');
  const SVGstatus = document.getElementById('status');

  if (trackingNumber.trim() !== '') {
    resultDiv.style.display = "block";
    SVGstatus.style.opacity = 1;
    SVGstatus.style.stroke = "grey";
  } else {
    resultDiv.style.display = "block";
    resultDiv.innerText = 'Por favor, insira um número de rastreamento.';
  }
}
 trackerBtn.addEventListener('click', trackPackage);