
const senhaInput = document.getElementById('senha');

const reqComprimento = document.getElementById('req-comprimento');
const reqMaiuscula = document.getElementById('req-maiuscula');
const reqNumero = document.getElementById('req-numero');

senhaInput.addEventListener('keyup', function() {
    const senha = senhaInput.value;

    if (senha.length >= 8) {
        reqComprimento.classList.remove('text-gray-500');
        reqComprimento.classList.add('text-green-600');
        reqComprimento.querySelector('span').innerHTML = '[✓]';
        reqComprimento.querySelector('span').classList.remove('text-red-500');
        reqComprimento.querySelector('span').classList.add('text-green-600');
    } else {
        reqComprimento.classList.add('text-gray-500');
        reqComprimento.classList.remove('text-green-600');
        reqComprimento.querySelector('span').innerHTML = '[X]';
        reqComprimento.querySelector('span').classList.add('text-red-500');
        reqComprimento.querySelector('span').classList.remove('text-green-600');
    }

    if (senha.match(/[A-Z]/)) {
        reqMaiuscula.classList.remove('text-gray-500');
        reqMaiuscula.classList.add('text-green-600');
        reqMaiuscula.querySelector('span').innerHTML = '[✓]';
        reqMaiuscula.querySelector('span').classList.remove('text-red-500');
        reqMaiuscula.querySelector('span').classList.add('text-green-600');
    } else {
        reqMaiuscula.classList.add('text-gray-500');
        reqMaiuscula.classList.remove('text-green-600');
        reqMaiuscula.querySelector('span').innerHTML = '[X]';
        reqMaiuscula.querySelector('span').classList.add('text-red-500');
        reqMaiuscula.querySelector('span').classList.remove('text-green-600');
    }

    if (senha.match(/\d/)) {
        reqNumero.classList.remove('text-gray-500');
        reqNumero.classList.add('text-green-600');
        reqNumero.querySelector('span').innerHTML = '[✓]';
        reqNumero.querySelector('span').classList.remove('text-red-500');
        reqNumero.querySelector('span').classList.add('text-green-600');
    } else {
        reqNumero.classList.add('text-gray-500');
        reqNumero.classList.remove('text-green-600');
        reqNumero.querySelector('span').innerHTML = '[X]';
        reqNumero.querySelector('span').classList.add('text-red-500');
        reqNumero.querySelector('span').classList.remove('text-green-600');
    }
});