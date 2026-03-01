<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>İletişim - Bir Buçuk Adana</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        rel="stylesheet"
    />
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .navbar {
            background-color: #161b22;
        }
        .navbar-brand,
        .nav-link {
            color: #c9d1d9 !important;
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        .nav-link:hover {
            color: #58a6ff !important;
            transition: color 0.3s ease;
        }
        .dropdown-menu {
            background-color: #161b22;
            border: none;
        }
        .dropdown-item {
            color: #c9d1d9;
        }
        .dropdown-item:hover {
            background-color: #0d1117;
            color: #58a6ff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .main-content {
            padding: 100px 15px;
            text-align: center;
            flex: 1;
        }
        .contact-info {
            margin-bottom: 30px;
        }
        .contact-info a {
            color: #58a6ff;
            text-decoration: none;
            margin: 0 15px;
        }
        .contact-info a:hover {
            color: #c9d1d9;
        }
        .contact-info i {
            font-size: 2rem;
        }
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        footer {
            background-color: #161b22;
            padding: 10px 0;
            text-align: center;
            color: #8b949e;
            width: 100%;
            margin-top: auto;
        }
        @media (max-width: 768px) {
            .main-content {
                padding: 30px 15px;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
@include('layouts.navbar')

<!-- Main Content -->
<div class="main-content">
    <h1 class="mb-4">Bizimle İletişime Geçin</h1>
    <div class="contact-info mb-4">
        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
        <a href="#"><i class="fas fa-envelope"></i></a>
        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
    <p>Adres: Çukurova Üniversitesi, Adana, Türkiye</p>

    <!-- Contact Form -->
    <div class="contact-form">
        <form id="contactForm">
            <div class="mb-3">
                <label for="name" class="form-label">İsim</label>
                <input type="text" class="form-control" id="name" required />
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Konu</label>
                <input type="text" class="form-control" id="subject" required />
            </div>
            <div class="mb-3">
                <label for="contactInfo" class="form-label">Mail Adresi</label>
                <input type="email" class="form-control" id="contactInfo" required />
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mesaj İçeriği</label>
                <textarea class="form-control" id="message" rows="4" required></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="sendEmail()">Gönder</button>
        </form>
    </div>
</div>

<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function sendEmail() {
        const name = document.getElementById('name').value;
        const subject = document.getElementById('subject').value;
        const contactInfo = document.getElementById('contactInfo').value;
        const message = document.getElementById('message').value;

        const data = {
            name,
            subject,
            contactInfo,
            message
        };

        fetch('https://your-backend-url/send-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if (response.ok) {
                    alert('Mesajınız başarıyla gönderildi!');
                } else {
                    alert('Mesajınız gönderilirken bir hata oluştu. Lütfen tekrar deneyin.');
                }
            })
            .catch(error => {
                alert('Bağlantı hatası: ' + error.message);
            });
    }
</script>
</body>
</html>
