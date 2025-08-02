    </div> <!-- penutup container dari header.php -->
    <footer class="footer-todo mt-auto py-3">
        <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap px-3">
            <span class="footer-copyright text-muted">
                &copy; <?= date('Y') ?> To-Do List App. All rights reserved.
            </span>
            <span class="footer-watermark ms-auto">
                <span class="ichi-mark">
                    <i class="fa-solid fa-water"></i>
                    <b>ichi</b>
                </span>
            </span>
        </div>
    </footer>
    <!-- Bootstrap JS (optional, jika belum di-load) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome JS (optional, jika belum di-load) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
    <style>
        .footer-todo {
            background: linear-gradient(90deg, #e0eafc 0%, #cfdef3 100%);
            box-shadow: 0 -2px 16px 0 rgba(80,100,255,0.07);
            border-top-left-radius: 1.3rem;
            border-top-right-radius: 1.3rem;
            color: #556a8a;
            font-size: 1.01em;
        }
        .footer-watermark .ichi-mark {
            opacity: .7;
            font-weight: 600;
            font-size: 1.1em;
            color: #7f7fd5;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            letter-spacing: .5px;
        }
        .footer-watermark .fa-water {
            font-size: 1.08em;
            color: #86a8e7;
            margin-right: 2px;
        }
        @media (max-width: 600px) {
            .footer-todo .container-fluid {
                flex-direction: column;
                gap: 6px;
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
                text-align: center;
            }
            .footer-watermark { margin-left: 0; }
        }
    </style>
</body>
</html>
