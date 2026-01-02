
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Medilab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 50px;
            color: #007bff;
            /* Changé de vert à bleu pour correspondre au login */
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            /* Couleur bleue Bootstrap */
            border-color: #007bff;
        }

        .btn-register:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</head>

<body>
    <div class="register-box">
        <div class="logo">
            <i class="bi bi-hospital"></i>
            <h2 class="mt-3">Créer un compte</h2>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text"
                        name="first_name"
                        class="form-control"
                        placeholder="Maurice"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text"
                        name="last_name"
                        class="form-control"
                        placeholder="Enkoura"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                    name="email"
                    class="form-control"
                    placeholder="exemple@email.com"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rôle</label>
                <select name="role" class="form-select" required>
                    <option value="">Choisir un rôle</option>
                    <option value="patient">Patient</option>
                    <option value="medecin">Médecin</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password"
                    name="password"
                    class="form-control"
                    placeholder="Minimum 8 caractères"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Retapez votre mot de passe"
                    required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox"
                    class="form-check-input"
                    name="terms"
                    id="terms"
                    required>
                <label class="form-check-label" for="terms">
                    J'accepte les conditions d'utilisation
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-register">
                <i class="bi bi-person-plus me-2"></i>
                S'inscrire
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    Déjà un compte ? Se connecter
                </a>
            </div>
        </form>
    </div>
</body>

</html>