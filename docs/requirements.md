# Functional & Non-Functional Requirements

## Functional Requirements

### User Stories / Use Cases
Each use case includes:
- Actor/role
- Preconditions
- Flow of events
- Postconditions
- Exceptions

#### Example Use Case: User Completes Lesson
**Actor:** User  
**Precondition:** User is logged in  
**Flow:**
1. User selects lesson
2. Completes steps
3. Progress updates  
**Postcondition:** Lesson marked complete  
**Exceptions:** Network failure

### Business Rules
- Input validation required for all user data
- Users must complete lessons sequentially
- Access control based on authentication state

---

## Non-Functional Requirements

### Performance Requirements
- App should load in under 3 seconds
- Support for increasing concurrent users
- API responses under 500ms

### Security Requirements
- Password encryption
- Secure session management
- Data encryption at rest and in transit
- Compliance with privacy standards

### Scalability & Availability
- 99% uptime goal
- Backup and disaster recovery strategy
- Should scale horizontally as user base grows
