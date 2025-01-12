const user = document.querySelector('.user');
const options = document.querySelector('.options');
const navLinks = document.querySelectorAll('.nav-links a');

user.addEventListener('click', () => {
  if (options.style.display === "flex") {
    options.style.display = "none";
  } else {
    options.style.display = "flex";
  }
});

document.addEventListener('click', (event) => {
  if (!user.contains(event.target) && !options.contains(event.target)) {
    options.style.display = "none";
  }
});

navLinks.forEach(link => {
  link.addEventListener('click', (e) =>{
    const target = e.target.closest('a');
    navLinks.forEach(nav => nav.classList.remove('active'));
    if(target){
      target.classList.add('active');
    }
  });
});

