const profileIcon = document.querySelector('.profile-icon');
const profileInfo = document.querySelector('.profile-info');

profileIcon.addEventListener('click', function() {
profileInfo.classList.toggle('open');
});

profileInfo.addEventListener('click', function(event) {
event.stopPropagation();
});

document.addEventListener('click', function() {
profileInfo.classList.remove('open');
});
