# MediBook Architecture Pack

## Plain-language request journey
Browser/mobile client → DNS and internet → EC2 security group → Apache → PHP page/service logic → SQLite database → HTML response.

## Demonstrated service boundaries
- Authentication: registration, hashed-password login, logout and session checks.
- Appointment booking: doctor directory and slot creation.
- Online consultation: safe simulated lobby.
- Payment: displayed consultation fees only; no payment collection.
- Notification: local event record only; no Twilio credentials or messages.
- AI chatbot: browser-side rule-based navigation assistant.
- Medical reports: access-controlled demo metadata only.
- L1 Support: structured ticket capture and service-health page.

## Why a service can be slow or fail
Resource exhaustion, application errors, database locks, network/DNS issues, dependency failures, incorrect configuration, failed deployment, certificate expiry, background-job contention or traffic spikes. L1 must capture evidence and avoid assuming a root cause.
