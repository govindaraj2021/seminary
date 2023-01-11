const shareBtn = document.querySelector('.share-btn');
const shareOption = document.querySelector('.share-option');
shareBtn.addEventListener('click', e => {
  shareOption.classList.toggle('active')
})