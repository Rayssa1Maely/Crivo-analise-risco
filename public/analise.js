const urlInput = document.getElementById("url-input");
const analyzeButton = document.getElementById("analyze-button");
const resultadoDiv = document.getElementById("resultado-analise");
const loadingIndicator = document.getElementById("loading-indicator");

analyzeButton.addEventListener("click", function () {
  const urlParaAnalisar = urlInput.value;
  if (!urlParaAnalisar) {
    alert("Por favor, insira uma URL.");
    return;
  }

  loadingIndicator.classList.remove("hidden");
  analyzeButton.disabled = true;
  analyzeButton.classList.add("opacity-50", "cursor-not-allowed");
  resultadoDiv.innerHTML = "";
  
  fetch("/crivo/analisar", {

    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded", 
    },
    body: "url=" + encodeURIComponent(urlParaAnalisar), 
  })
    .then((response) => response.text()) 
    .then((html) => {
      resultadoDiv.innerHTML = html;
    })
    .catch((error) => {
      console.error("Erro na requisição:", error);
      resultadoDiv.innerHTML =
        '<p class="text-red-600 text-center">Ocorreu um erro ao analisar a URL. Tente novamente.</p>';
    })
    .finally(() => {
      loadingIndicator.classList.add("hidden");
      analyzeButton.disabled = false;
      analyzeButton.classList.remove("opacity-50", "cursor-not-allowed");
    });
});
