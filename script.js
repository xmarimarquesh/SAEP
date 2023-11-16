document.getElementById('carForm').addEventListener('submit', function(event) {
  


    let marca = document.getElementById('nome').value;
   
    
    if (nome === "") {
        showMessage("Por favor, insira um nome.");
        event.preventDefault();
        return;
    }

    
    showMessage("Carro registrado com sucesso!");

  
});

function showMessage(msg, type = 'danger') {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = msg;
    messageDiv.style.display = 'block';
    
    messageDiv.classList.remove('alert-danger', 'alert-success');
    
    if(type === 'success') {
        messageDiv.classList.add('alert-success');
    } else {
        messageDiv.classList.add('alert-danger');
    }
}
const formContainer = document.getElementById('carForm');
const toggleButton = document.getElementById('toggleFormButton');

toggleButton.addEventListener('click', function() {
    if (formContainer.style.display === 'none' || formContainer.style.display === '') {
        formContainer.style.display = 'block';
        toggleButton.innerText = 'Esconder Cadastro';
    } else {
        formContainer.style.display = 'none';
        toggleButton.innerText = 'Cadastrar Turma';
    }
});
