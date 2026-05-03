# Security Layer Implementation

## Overview  
The application implements a security layer to ensure that user data and application features are only accessible to authorized users. This is achieved using a role-based access control (RBAC) model, combined with authentication, session management, and infrastructure-level protections.

---

## Authentication (User Verification)  
Authentication is handled using PHPAuth, which provides secure login and registration functionality. PHPAuth ensures that user passwords are hashed and stored securely, and it manages session tokens to maintain user identity across pages.

**Role in the application:**  
- Handles user login and registration  
- Encrypts and verifies passwords  
- Maintains active user sessions  
- Prevents unauthorized access to protected pages  

---

## Authorization (Role-Based Access Control)  
The application uses a role-based access control system to manage permissions. In this model, users are assigned roles, and each role determines what actions the user is allowed to perform.

**Roles implemented:**  
- **User**  
  - View lessons and exercises  
  - Interact with learning content  

- **Admin**  
  - All User permissions  
  - Ability to update or delete data  

**Role in the application:**  
- Permissions are assigned to roles instead of individual users  
- Users inherit permissions based on their role  
- Access is checked before performing restricted actions  

---

## Example Security Implementation  
The application includes a working example of role-based security using a restricted action.

**Example: Delete Operation**  
- A user with the **User** role is shown a message indicating they do not have permission to delete  
- A user with the **Admin** role is able to access and perform the delete action  

---

## Role Management Interface  
A simple interface is included to manage user roles within the application.

**Features:**  
- Users can switch between “User” and “Admin” roles  
- Role changes are reflected immediately in the application  
- Used for testing and demonstration purposes  

---

## Database Security (MySQL Layer)  
MySQL is used to store user data and application content. Security is maintained through controlled database access and structured queries.

**Role in the application:**  
- Stores user accounts and credentials  
- Stores lesson content and user progress  
- Uses PDO for database communication  

**Planned improvements:**  
- Use of prepared statements to prevent SQL injection  
- Validation of all user input before database queries  

---

## Hosting & Infrastructure Security (DigitalOcean)  
The application is hosted on DigitalOcean, which provides additional security at the infrastructure level.

**Role in the application:**  
- Secure database connections  
- Network-level access restrictions  
- Managed environment for application deployment  
- SSL/HTTPS support for encrypted communication  

---

## Planned Security Enhancements  
To further improve security, the following features are planned:

- Input validation and sanitization  
- Prepared statements to prevent SQL injection  
- Improved session management  
- Storing roles in the database  
- Stronger password policies  

---

## Summary  
The application’s security layer combines authentication, authorization, database protection, and infrastructure-level security. By implementing role-based access control and enforcing permissions at the application level, the system ensures that only authorized users can access or modify sensitive data.
