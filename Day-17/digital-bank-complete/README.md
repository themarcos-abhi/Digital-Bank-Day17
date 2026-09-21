# Digital Bank

A complete working MVP banking portal built with React, Express, MySQL, Docker, and Nginx.

## Features
- Customer registration and login with JWT authentication
- Password hashing with bcrypt
- Home, Savings Account, Personal Account, Cards, Services, and Dashboard pages
- User registration details stored in MySQL
- Account balance, recent transactions, card status, and profile APIs
- Nginx serves the React application and reverse-proxies `/api` to the backend
- Docker Compose starts frontend, backend, and database
- Health checks, validation, rate limiting, Helmet, and parameterized ORM queries

## Quick start
1. Copy `.env.example` to `.env`.
2. Change all sample secrets in `.env`.
3. Run:
   ```bash
   docker compose up --build -d
   ```
4. Open `http://localhost`.
5. Register a customer and sign in.

## Local development
### Database
Run MySQL and create a database named `digital_bank`, or start only the Docker database:
```bash
docker compose up -d mysql
```

### Backend
```bash
cd backend
npm install
cp ../.env.example .env
npm run dev
```

### Frontend
```bash
cd frontend
npm install
npm run dev
```
Vite runs at `http://localhost:5173` and proxies `/api` to `http://localhost:5000`.

## Production notes
This is a training/demo MVP, not a licensed core-banking system. Before real use, add MFA, database encryption/KMS, secret management, audit logging, fraud controls, regulatory/KYC workflows, tested backup/restore, observability, dependency scanning, penetration testing, and an approved PCI DSS design. Never store a real CVV after authorization. This project stores only a masked card number and does not store CVV.

## Structure
- `frontend/`: React/Vite user interface
- `backend/`: Express REST API and Sequelize models
- `nginx/`: production web server configuration
- `mysql/`: optional initialization SQL
- `docker-compose.yml`: complete deployment
- `API.md`: API summary

## Useful commands
```bash
docker compose ps
docker compose logs -f backend
docker compose down
docker compose down -v   # also deletes database volume
```
