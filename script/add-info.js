const promptMess = document.querySelector('.prompt');

function showPrompt(message){
  promptMess.style.display = 'block';
  promptMess.innerHTML = message;
}