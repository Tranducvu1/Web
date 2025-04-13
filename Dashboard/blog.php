<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Adoption</title>
  <style>
 
html {
    scroll-behavior: smooth;
  }
.donate-bg {
    background-image: url(bg.avif);
    background-repeat: no-repeat;
    background-attachment: fixed;  /* Cố định nền  */
    object-fit: cover;
    background-size: cover;
}

.navbar {
    background: #199d6a;
    color: #222;
    box-shadow: 0 -2px 12px rgba(0, 0, 0, .07);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
  }
  
  .navbar .navbar-brand img {
    width: 130px;
    height: auto;
  }
  
  .navbar-nav .nav-link {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-size: 15px;
    letter-spacing: .2px;
    color: white;
    border-radius: 22px;
    padding: 8px 16px;
  }
  
  .navbar-nav .nav-link:hover {
    color: black;
    background: #bbca16;
    transition: 0.25s;
    cursor: pointer;
  }
  

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 100%, 0);
    }

    to {
        opacity: 1;
        transform: none;
    }
  }
      
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
      padding-top: 70px; 
    }
    .container {
      width: 90%;
      margin: 20px auto;
      max-width: 1200px;
    }
    .posts-section {
      margin: 40px 0;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    h2 {
      color: #333;
    }
    .post {
      margin-bottom: 20px;
      padding: 15px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      gap: 15px;
    }
    .post img {
      max-width: 150px;
      max-height: 150px;
      border-radius: 10px;
    }
    .post-details {
      flex: 1;
    }
    .post-details h3 {
      margin: 0 0 10px;
      color: #333;
    }
    .post-details p {
      margin: 5px 0;
      color: #555;
    }
    .post-actions {
  margin-top: 10px;
  display: flex;
  flex-wrap: wrap; /* Đảm bảo nút xuống dòng nếu không đủ chỗ */
  gap: 10px; /* Khoảng cách giữa các nút */
  justify-content: flex-start; /* Canh trái */
}
.post-actions button,
.post-actions a {
  flex: 0 1 auto; /* Tự điều chỉnh kích thước nút để vừa với bố cục */
  min-width: 100px; /* Đặt chiều rộng tối thiểu */
  text-align: center; /* Canh giữa văn bản trong nút */
}
@media (max-width: 576px) {
  .post-actions {
    gap: 15px; /* Tăng khoảng cách giữa các nút */
  }
}

    .post-actions button {
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .like-btn {
      background-color: #ff6868;
      color: white;
    }
    .like-btn:hover {
      background-color: #ff4d4d;
    }
    .comment-btn {
      background-color: #4caf50;
      color: white;
    }
    .comment-btn:hover {
      background-color: #45a049;
    }
    .contact-btn {
      background-color: #007bff;
      color: white;
    }
    .contact-btn:hover {
      background-color: #0056b3;
    }
    .comments-section {
      margin-top: 10px;
      border-top: 1px solid #ddd;
      padding-top: 10px;
    }
    .comments-section input {
      width: calc(100% - 50px);
      padding: 5px;
      margin-right: 5px;
    }
    .comments-section button {
      padding: 5px 10px;
    }
    .comment {
      margin-top: 5px;
      font-size: 14px;
      color: #444;
    }
    .lh{
  padding: 8px;
  border: 1px solid black;
  background: #199d6a;
  border-radius: 6px;
  text-decoration: none;
  font-family: arial;
  color: #fff;
  
  box-shadow: 3px 3px 0px rgb(44, 44, 19);
}
.lh:hover{
  padding: 11px;
  background-color: #04e562;
 
  transition: 0.1s;
}
.add-comment-btn{
  border-radius: 6px;
  margin: 10px;
}
  </style>
</head>
<body>   
<?php include 'Header/header.php'; ?>
  <div class="container">
    <div class="posts-section">
      <h2>Danh sách thú cưng đang tìm người nhận nuôi</h2>
      <div id="postsContainer">
        <!-- Bài đăng sẽ được hiển thị tại đây -->
      </div>
    </div>
  </div>

  <script>
    const postsContainer = document.getElementById('postsContainer');

    // Lấy bài đăng từ Local Storage
    const posts = JSON.parse(localStorage.getItem('petPosts')) || [];

    // Hàm lưu bài đăng vào Local Storage
    function savePosts() {
      localStorage.setItem('petPosts', JSON.stringify(posts));
    }

    // Hàm hiển thị bài đăng
    function renderPost(post, index) {
      const postElement = document.createElement('div');
      postElement.classList.add('post');
      postElement.innerHTML = `
        <img src="${post.image}" alt="${post.name}">
        <div class="post-details">
          <h3>${post.name}</h3>
          <p>${post.description}</p>
          <div class="post-actions">
            <button class="like-btn">❤️ ${post.likes || 0}</button>
            <button class="comment-btn">💬 Bình luận</button>
            <button >   <a href="https://www.facebook.com/profile.php?id=61559304898620&is_tour_dismissed" class="lh" target="_blank"id="doi" onclick="thaydoi();">Liên hệ</a></button>
          </div>
          <div class="comments-section">
            <input type="text" placeholder="Thêm bình luận...">
            <button class="add-comment-btn ">Gửi</button>
            <div class="comments-list">
              ${(post.comments || []).map(comment => `<div class="comment">- ${comment}</div>`).join('')}
            </div>
          </div>
        </div>
      `;

      // Xử lý sự kiện cho nút Like
      const likeButton = postElement.querySelector('.like-btn');
      likeButton.addEventListener('click', () => {
        post.likes = (post.likes || 0) + 1;
        likeButton.textContent = `❤️ ${post.likes}`;
        savePosts();
      });

      // Xử lý sự kiện cho nút Bình luận
      const addCommentButton = postElement.querySelector('.add-comment-btn');
      const commentInput = postElement.querySelector('.comments-section input');
      const commentsList = postElement.querySelector('.comments-list');

      addCommentButton.addEventListener('click', () => {
        const comment = commentInput.value.trim();
        if (comment) {
          post.comments = post.comments || [];
          post.comments.push(comment);
          commentsList.innerHTML += `<div class="comment">- ${comment}</div>`;
          commentInput.value = '';
          savePosts();
        }
      });

      // Thêm bài đăng vào container
      postsContainer.appendChild(postElement);
    }

    // Hiển thị tất cả bài đăng hiện có
    function renderAllPosts() {
        postsContainer.innerHTML = ''; // Xóa nội dung cũ
        const posts = JSON.parse(localStorage.getItem('petPosts')) || [];
        if (posts.length === 0) {
            postsContainer.innerHTML = '<p>Chưa có bài đăng nào.</p>';
        } else {
            posts.forEach((post, index) => renderPost(post, index));
        }
    }

    // Lắng nghe sự kiện storage
    window.addEventListener('storage', function (event) {
        if (event.key === 'petPosts') {
            renderAllPosts(); // Tự động cập nhật danh sách bài đăng
        }
    });

    // Hiển thị danh sách bài đăng ban đầu
    renderAllPosts();
    
  </script>
</body>
</html>
