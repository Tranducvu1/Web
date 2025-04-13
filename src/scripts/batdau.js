// Lặp qua tất cả các thẻ `.card`
const cards = document.querySelectorAll('.card');

// Thêm sự kiện `mouseover` cho mỗi thẻ `.card`
cards.forEach((card, index) => {
  card.addEventListener('mouseover', () => {
    // Xóa class `active` khỏi tất cả các thẻ `.card`
    cards.forEach(c => c.classList.remove('active'));
    // Thêm class `active` vào thẻ `.card` được hover
    card.classList.add('active');
  });
});