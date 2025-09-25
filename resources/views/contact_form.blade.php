<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us</title>

  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <style>
    body {
      background: #ffffff;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
    }
    .contact-wrap {

      border-radius: .5rem;
      padding: 1.25rem;
    }
    @media (min-width: 768px){
      .contact-wrap { padding: 1.5rem; }
    }
    .contact-title {
      font-weight: 700;
      font-size: clamp(2rem, 3vw, 2.75rem);
      text-align: center;
      margin-bottom: 1rem;
      font-family: Georgia, "Times New Roman", Times, serif; /* örnekteki serif başlığa yakın */
    }
    .contact-card {
      background: transparent;
      border: 0;
    }
    .form-label .req {
      color: #dc3545;
      margin-left: .15rem;
    }
    /* Görseldeki açık mavi input yüzeyi */
    .form-control, .form-select {
      background-color: #eef5ff;
      border-color: #eef5ff;
    }
    .form-control:focus, .form-select:focus {
      background-color: #eef5ff;
      border-color: #b9d4ff;
      box-shadow: 0 0 0 .25rem rgba(13,110,253,.1);
    }
    /* Gönder butonu siyah */
    .btn-submit {
      background: #000;
      color: #fff;
      width: 100%;
      padding-block: .9rem;
      letter-spacing: .5px;
      font-weight: 600;
    }
    .flag {
      font-size: 1.1rem;
      line-height: 1;
      margin-right: .25rem;
    }
    .input-group .dropdown-toggle {
      background: #eef5ff;
      border-color: #eef5ff;
    }
  </style>
</head>
<body>
  <main class="container py-4 py-md-5">
    <h1 class="contact-title">Contact Us</h1>

    <div class="contact-wrap mx-auto bg-light" style="max-width: 960px;" >


      <form class="contact-card needs-validation" method="POST" novalidate action="{{route('form.submit',3)}}">
        @csrf
        <input type="hidden" name="id" value="3">
        <div class="mb-3">
          <label for="name" class="form-label">Name Surname <span class="req">*</span></label>
          <input type="text" class="form-control" name="namesurname" id="4799fdfd-b3de-48b0-b93c-78042de46834-namesurname" value="" placeholder="Name Surname" required="">
          <div class="invalid-feedback">Lütfen ad soyad giriniz.</div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" name="email" id="4799fdfd-b3de-48b0-b93c-78042de46834-email" required value="" placeholder="E-mail">
          <div class="invalid-feedback">Geçerli bir e-posta giriniz.</div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone <span class="req">*</span></label>
            <div class="input-group" >
              <!-- Ülke kodu select -->
              <select class="form-select country-select" name="country_code" style="max-width: 200px" id="country_code" aria-label="Country code">
                <option value="+90" selected>Türkiye (+90)</option>
                <option value="+1">USA (+1)</option>
                <option value="+44">UK (+44)</option>
                <option value="+49">DE (+49)</option>
                <!-- İhtiyaca göre ekleyin -->
              </select>

              <input type="tel" class="form-control" id="phone" name="phone"
                     placeholder="0501 234 56 78" required inputmode="tel" />
              <div class="invalid-feedback">Lütfen telefon numarası giriniz.</div>
            </div>
          </div>

        <div class="mb-3">
          <label for="message" class="form-label">Message <span class="req">*</span></label>
          <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message" required></textarea>
          <div class="invalid-feedback" >Lütfen bir mesaj yazınız.</div>
        </div>

        <button type="submit" class="btn btn-submit">SUBMIT</button>
      </form>
    </div>
  </main>

  <!-- Bootstrap 5 JS (Popper dâhil) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Basit Bootstrap doğrulama -->
  <script>
    (() => {
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>
