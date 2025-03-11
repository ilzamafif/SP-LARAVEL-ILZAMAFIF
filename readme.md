## Installation Steps (Laravel)

1. Clone the repository:
```bash
git clone https://github.com/ilzamafif/SP-LARAVEL-ILZAMAFIF.git
cd SP-LARAVEL-ILZAMAFIF/laravel
```

2. Install PHP dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Configure database settings in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=password

NODE_SERVICE_URL=http://localhost:5000
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Start the development server:
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Instalation Step {Node JS}

1. Clone the repository:
```bash
git clone https://github.com/ilzamafif/SP-LARAVEL-ILZAMAFIF.git
cd SP-LARAVEL-ILZAMAFIF/express-service
```

2. Install PHP dependencies:
```bash
npm install
```
3. Configure settings in `.env` file:
```
PORT=5000
```

4. Start the server:
```bash
npm run dev # development
npm run start
```