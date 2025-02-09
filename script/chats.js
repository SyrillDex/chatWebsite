const convo = document.querySelector('.convo-body');

function sendMessage(message){
  convo.innerHTML = message;
}
document.addEventListener('DOMContentLoaded', () =>{
  const searchInput = document.querySelector('.search-text');
  const searchForm = document.querySelector('.search-form');
  
  if (searchInput && searchForm){
    searchInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter'){
        e.preventDefault();
        searchForm.submit();
      }
    });
  }
});


function searchResult(username, pic){
  const chatList = document.querySelector('.chat-list');

  if(chatList){
    const userItem = document.createElement('div');
    userItem.className = 'user-item';
    userItem.textContent = username;
    chatList.appendChild(userItem);
    // if(userItem){
    //   const userPic = document.createElement('div');
    //   userPic.className = 'user-pic';
    //   userPic.textContent = pic;
    //   chatList.appendChild(userPic);
    // }
  }
}
