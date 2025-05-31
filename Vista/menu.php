<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Green Mantenimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-50: #f0fdf4;
            --primary-100: #dcfce7;
            --primary-200: #bbf7d0;
            --primary-300: #86efac;
            --primary-400: #4ade80;
            --primary-500: #22c55e;
            /* Verde principal más vibrante */
            --primary-600: #16a34a;
            --primary-700: #15803d;
            --primary-800: #166534;
            --primary-900: #14532d;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --dark-bg: #121212;
            --dark-secondary: #1e1e1e;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-800);
            line-height: 1.6;
            font-weight: 400;
            transition: var(--transition);
            display: flex;
            min-height: 100vh;
        }

        /* Modo oscuro */
        .dark-mode {
            background-color: var(--dark-bg);
            color: var(--gray-200);
        }

        .dark-mode .card,
        .dark-mode .dropdown-menu {
            background-color: var(--dark-secondary);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .dark-mode .text-muted {
            color: var(--gray-400) !important;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--white);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .dark-mode .sidebar {
            background-color: var(--dark-secondary);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid var(--gray-200);
        }

        .dark-mode .sidebar-brand {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand img {
            height: 50px;
            margin-right: 12px;
        }

        .sidebar-brand span {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary-700);
        }

        .dark-mode .sidebar-brand span {
            color: var(--primary-400);
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-item {
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            color: var(--gray-600);
            text-decoration: none;
            transition: var(--transition);
        }

        .dark-mode .sidebar-item {
            color: var(--gray-300);
        }

        .sidebar-item i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-item:hover {
            background-color: var(--primary-50);
            color: var(--primary-600);
        }

        .dark-mode .sidebar-item:hover {
            background-color: rgba(34, 197, 94, 0.1);
        }

        .sidebar-item.active {
            background-color: var(--primary-100);
            color: var(--primary-700);
            font-weight: 500;
        }

        .dark-mode .sidebar-item.active {
            background-color: rgba(34, 197, 94, 0.2);
            color: var(--primary-400);
        }

        .sidebar-shortcut {
            margin-left: auto;
            background-color: var(--primary-100);
            color: var(--primary-700);
            border-radius: 4px;
            padding: 2px 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .dark-mode .sidebar-shortcut {
            background-color: rgba(34, 197, 94, 0.3);
            color: var(--primary-300);
        }

        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
            transition: var(--transition);
        }

        /* Top navbar */
        .top-navbar {
            background-color: var(--white);
            box-shadow: var(--shadow-sm);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .dark-mode .top-navbar {
            background-color: var(--dark-secondary);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Search bar */
        .search-container {
            position: relative;
            width: 350px;
        }

        .search-input {
            border-radius: 50px;
            padding: 0.75rem 1.5rem 0.75rem 3rem;
            border: 1px solid var(--gray-200);
            background-color: var(--white);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .dark-mode .search-input {
            background-color: var(--dark-secondary);
            border-color: rgba(255, 255, 255, 0.1);
            color: var(--gray-200);
        }

        .search-input:focus {
            box-shadow: var(--shadow-md);
            border-color: var(--primary-400);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-500);
            font-size: 1.1rem;
        }

        /* User profile */
        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            transition: var(--transition);
        }

        .user-profile:hover {
            background-color: rgba(34, 197, 94, 0.1);
        }

        .dark-mode .user-profile:hover {
            background-color: rgba(34, 197, 94, 0.2);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-700));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* Notification */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Session timer */
        .session-timer {
            color: white;
            font-weight: 600;
            font-size: 1rem;
            background: var(--primary-600);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            margin-right: 1rem;
        }

        .dark-mode .session-timer {
            background: var(--primary-700);
        }

        .session-timer i {
            margin-right: 0.5rem;
        }

        /* Theme toggle */
        .theme-toggle {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 1.25rem;
            cursor: pointer;
            transition: var(--transition);
            margin-left: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .dark-mode .theme-toggle {
            color: var(--gray-300);
        }

        .theme-toggle:hover {
            background-color: rgba(0, 0, 0, 0.05);
            transform: rotate(30deg);
        }

        .dark-mode .theme-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Dashboard cards */
        .dashboard-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .dark-mode .dashboard-card {
            background: var(--dark-secondary);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-5px);
        }

        .dashboard-card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
        }

        .dark-mode .dashboard-card-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dashboard-card-header i {
            font-size: 1.5rem;
            color: var(--primary-500);
            margin-right: 1rem;
        }

        .dashboard-card-body {
            padding: 1.5rem;
        }

        /* Shortcuts */
        .shortcut-combo {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .shortcut-key {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 8px;
            background-color: var(--primary-500);
            color: white;
            border-radius: 6px;
            margin: 0 4px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow-sm);
        }

        .shortcut-label {
            margin-left: 1rem;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .search-container {
                width: 100%;
                margin: 1rem 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <img src="../img/LogoGreen.png" alt="Logo Green Mantenimiento">
            <span>Green Mantenimiento</span>
        </div>

        <div class="sidebar-menu">
            <a href="#" class="sidebar-item active">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="#" class="sidebar-item" data-shortcut="C">
                <i class="bi bi-people-fill"></i>
                <span>Clientes</span>
                <span class="sidebar-shortcut">Ctrl+C</span>
            </a>

            <a href="#" class="sidebar-item" data-shortcut="S">
                <i class="bi bi-box-seam"></i>
                <span>Servicios</span>
                <span class="sidebar-shortcut">Ctrl+S</span>
            </a>

            <a href="#" class="sidebar-item" data-shortcut="M">
                <i class="bi bi-tools"></i>
                <span>Mantenimientos</span>
                <span class="sidebar-shortcut">Ctrl+M</span>
            </a>

            <div class="sidebar-divider"></div>

            <a href="#" class="sidebar-item">
                <i class="bi bi-gear"></i>
                <span>Configuración</span>
            </a>

            <a href="#" class="sidebar-item" id="toggleThemeBtn">
                <i class="bi bi-moon"></i>
                <span>Modo Oscuro</span>
                <span class="sidebar-shortcut">Ctrl+T</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <div class="search-container d-none d-lg-block">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="form-control search-input" id="globalSearch" placeholder="Buscar (Ctrl+B)"
                    aria-label="Buscar">
                <div class="dropdown-menu w-100 p-0" id="searchResults" style="display: none;"></div>
            </div>

            <div class="d-flex align-items-center">
                <div class="session-timer">
                    <i class="bi bi-clock"></i>
                    <span id="session-timer">15:00</span>
                </div>

                <a href="#" class="nav-link position-relative me-3">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge">3</span>
                </a>

                <button class="theme-toggle" id="themeToggle">
                    <i class="bi bi-sun"></i>
                </button>

                <div class="dropdown">
                    <div class="user-profile dropdown-toggle" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($_SESSION["user"], 0, 1)); ?>
                        </div>
                        <span class="d-none d-md-inline">
                            <?php echo $_SESSION["user"]; ?>
                        </span>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Mi perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-key me-2"></i> Cambiar contraseña</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../index.php"><i class="bi bi-box-arrow-right me-2"></i>
                                Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-card fade-in-up">
            <div class="dashboard-card-header">
                <i class="bi bi-keyboard"></i>
                <h5 class="mb-0">Atajos de teclado</h5>
            </div>
            <div class="dashboard-card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="shortcut-combo">
                            <span class="shortcut-key">Ctrl</span>
                            <span class="shortcut-key">B</span>
                            <span class="shortcut-label">Buscar en el sistema</span>
                        </div>
                        <div class="shortcut-combo">
                            <span class="shortcut-key">Ctrl</span>
                            <span class="shortcut-key">C</span>
                            <span class="shortcut-label">Ir a Clientes</span>
                        </div>
                        <div class="shortcut-combo">
                            <span class="shortcut-key">Ctrl</span>
                            <span class="shortcut-key">S</span>
                            <span class="shortcut-label">Ir a Servicios</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shortcut-combo">
                            <span class="shortcut-key">Ctrl</span>
                            <span class="shortcut-key">M</span>
                            <span class="shortcut-label">Ir a Mantenimientos</span>
                        </div>
                        <div class="shortcut-combo">
                            <span class="shortcut-key">Ctrl</span>
                            <span class="shortcut-key">T</span>
                            <span class="shortcut-label">Cambiar tema</span>
                        </div>
                        <div class="shortcut-combo">
                            <span class="shortcut-key">Ctrl</span>
                            <span class="shortcut-key">/</span>
                            <span class="shortcut-label">Mostrar ayuda</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme toggle functionality
        const toggleThemeBtn = document.getElementById('toggleThemeBtn');
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;
        const icon = themeToggle.querySelector('i');

        // Check for saved theme preference
        if (localStorage.getItem('theme') === 'dark') {
            enableDarkMode();
        }

        if (toggleThemeBtn) toggleThemeBtn.addEventListener('click', toggleTheme);
        if (themeToggle) themeToggle.addEventListener('click', toggleTheme);

        function toggleTheme() {
            if (body.classList.contains('dark-mode')) {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        }

        function enableDarkMode() {
            body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
            icon.classList.remove('bi-sun');
            icon.classList.add('bi-moon');
            // Cambiar el texto del botón
            if (toggleThemeBtn) {
                toggleThemeBtn.innerHTML = '<i class="bi bi-sun"></i> Modo Claro <span class="sidebar-shortcut">Ctrl+T</span>';
            }
        }

        function disableDarkMode() {
            body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
            icon.classList.remove('bi-moon');
            icon.classList.add('bi-sun');
            // Cambiar el texto del botón
            if (toggleThemeBtn) {
                toggleThemeBtn.innerHTML = '<i class="bi bi-moon"></i> Modo Oscuro <span class="sidebar-shortcut">Ctrl+T</span>';
            }
        }

        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Global search functionality
        const globalSearch = document.getElementById('globalSearch');
        const searchResults = document.getElementById('searchResults');

        globalSearch.addEventListener('input', function () {
            if (this.value.length > 2) {
                // Simulate search results
                const mockResults = [
                    { icon: 'bi-people-fill', text: `Cliente: ${this.value}`, category: 'Clientes' },
                    { icon: 'bi-box-seam', text: `Servicios: ${this.value}`, category: 'Servicios' },
                    { icon: 'bi-file-earmark-text', text: `Reporte de ${this.value}`, category: 'Documentos' }
                ];

                searchResults.innerHTML = '';

                // Group results by category
                const categories = {};
                mockResults.forEach(result => {
                    if (!categories[result.category]) {
                        categories[result.category] = [];
                    }
                    categories[result.category].push(result);
                });

                // Display grouped results
                for (const [category, items] of Object.entries(categories)) {
                    const categoryHeader = document.createElement('h6');
                    categoryHeader.className = 'dropdown-header';
                    categoryHeader.textContent = category;
                    searchResults.appendChild(categoryHeader);

                    items.forEach(item => {
                        const resultItem = document.createElement('a');
                        resultItem.className = 'dropdown-item';
                        resultItem.href = '#';
                        resultItem.innerHTML = `
                            <i class="bi ${item.icon} me-2"></i>
                            ${item.text}
                        `;
                        resultItem.addEventListener('click', function (e) {
                            e.preventDefault();
                            alert(`Redirigiendo a: ${item.text}`);
                        });
                        searchResults.appendChild(resultItem);
                    });
                }

                searchResults.style.display = 'block';
            } else {
                searchResults.style.display = 'none';
            }
        });

        // Close search results when clicking outside
        document.addEventListener('click', function (e) {
            if (!globalSearch.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function (e) {
            // Ctrl+B for search
            if (e.ctrlKey && e.key.toLowerCase() === 'b') {
                e.preventDefault();
                globalSearch.focus();
            }

            // Ctrl+/ for help
            if (e.ctrlKey && e.key === '/') {
                e.preventDefault();
                showShortcutHelp();
            }

            // Ctrl+T for theme toggle
            if (e.ctrlKey && e.key.toLowerCase() === 't') {
                e.preventDefault();
                toggleTheme();
            }

            // Menu shortcuts
            if (e.ctrlKey) {
                switch (e.key.toLowerCase()) {
                    case 'c':
                        e.preventDefault();
                        alert('Redirigiendo a Clientes');
                        break;
                    case 's':
                        e.preventDefault();
                        alert('Redirigiendo a Servicios');
                        break;
                    case 'm':
                        e.preventDefault();
                        alert('Redirigiendo a Mantenimientos');
                        break;
                }
            }
        });

        function showShortcutHelp() {
            const helpContent = `
                <div class="p-3">
                    <h5><i class="bi bi-keyboard"></i> Atajos de teclado</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><kbd>Ctrl</kbd> + <kbd>B</kbd> - Buscar en el sistema</li>
                        <li class="mb-2"><kbd>Ctrl</kbd> + <kbd>C</kbd> - Ir a Clientes</li>
                        <li class="mb-2"><kbd>Ctrl</kbd> + <kbd>S</kbd> - Ir a Servicios</li>
                        <li class="mb-2"><kbd>Ctrl</kbd> + <kbd>M</kbd> - Ir a Mantenimientos</li>
                        <li class="mb-2"><kbd>Ctrl</kbd> + <kbd>T</kbd> - Cambiar tema</li>
                        <li class="mb-2"><kbd>Ctrl</kbd> + <kbd>/</kbd> - Mostrar ayuda</li>
                    </ul>
                </div>
            `;

            // Create a modal or use a toast notification to show help
            alert('Atajos de teclado disponibles:\n\n' +
                'Ctrl+B - Buscar\n' +
                'Ctrl+C - Clientes\n' +
                'Ctrl+S - Servicios\n' +
                'Ctrl+M - Mantenimientos\n' +
                'Ctrl+T - Cambiar tema\n' +
                'Ctrl+/ - Mostrar ayuda');
        }

        // Temporizador de sesión (1 minuto con reinicio por actividad)
        let timerDuration = 1 * 60; // 1 minuto en segundos
        let timerDisplay = document.getElementById('session-timer');
        let timerInterval;

        function resetTimer() {
            timerDuration = 1 * 60; // Reinicia a 1 minuto
            updateTimer();
        }

        function updateTimer() {
            let minutes = Math.floor(timerDuration / 60);
            let seconds = timerDuration % 60;
            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            if (timerDuration > 0) {
                timerDuration--;
            } else {
                clearInterval(timerInterval);
                window.location.href = '../index.php';
            }
        }

        // Inicia el temporizador
        function startTimer() {
            clearInterval(timerInterval);
            timerInterval = setInterval(updateTimer, 1000);
            resetTimer();
        }

        // Reinicia el temporizador en cualquier actividad del usuario
        ['click', 'mousemove', 'keydown', 'scroll', 'touchstart'].forEach(evt => {
            document.addEventListener(evt, resetTimer);
        });

        startTimer();
    </script>
</body>

</html>