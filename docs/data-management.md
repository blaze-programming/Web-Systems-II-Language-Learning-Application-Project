# Data Management

## Data Models & Relationships
- User → Progress → Lessons (1-to-many)
- Language → Lessons (1-to-many)
- User → Selected language (one-to-one)

## Data Flow Diagrams
(To be added after architecture decisions)

## Data Retention Policies
- User progress stored indefinitely unless user deletes account
- Temporary cache cleared after 30 days

## Privacy Requirements
- Store minimal personal data
- Provide account deletion on request
- Comply with relevant privacy laws

## Backup Strategies
- Daily automatic backups
- Offsite backup storage
