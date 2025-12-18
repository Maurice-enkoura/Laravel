<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Medilab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        
        body {
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 50px;
            color: #007bff;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
        }




    </style>
</head>

<body>
    <div class="login-box">
        <div class="logo">
            <i class="bi bi-hospital"></i>
            <h2 class="mt-3">Medilab</h2>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            Email ou mot de passe incorrect
        </div>
        @endif

        <form method="POST" action="">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                    name="email"
                    class="form-control"
                    placeholder="exemple@email.com"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password"
                    name="password"
                    class="form-control"
                    placeholder="Votre mot de passe"
                    required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox"
                    class="form-check-input"
                    name="remember"
                    id="remember">
                <label class="form-check-label" for="remember">
                    Se souvenir de moi
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Se connecter
            </button>

            <div class="text-center mt-3">
                <a href="" class="text-decoration-none">
                    Créer un compte
                </a>
            </div>
        </form>
    </div>
</body>

</html>