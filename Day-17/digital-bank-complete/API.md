# REST API

Base prefix: `/api`

## Public
- `GET /health` - service status
- `POST /auth/register` - create a customer and savings account
- `POST /auth/login` - return a JWT

## Authenticated
Send `Authorization: Bearer <token>`.
- `GET /users/me` - customer profile
- `PUT /users/me` - update contact/profile fields
- `GET /accounts` - customer accounts
- `GET /transactions` - recent transactions
- `POST /transactions` - demo deposit, withdrawal, or transfer
- `GET /cards` - customer cards
- `POST /cards` - apply for a masked demo card
- `PATCH /cards/:id/toggle` - freeze/unfreeze a card
- `GET /services` - catalog of services
