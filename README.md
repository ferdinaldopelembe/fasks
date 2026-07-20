# Fasks — Task Manager

**Fasks** ("Tasks - Make it ease") is a complete task management application designed to offer a simple, modern, and efficient experience for organizing routines and commitments. The project features secure authentication via JSON Web Token (JWT) within the Spring Framework ecosystem, alongside a responsive web interface with support for **Light Mode** and **Dark Mode**.

---

## Technologies Used

### **Backend**
- **Java**
- **Spring Boot** (Spring MVC, Spring Data JPA, Spring Security)
- **JSON Web Token (JWT)** (Stateless authentication)
- **Relational Database** (H2 / PostgreSQL / MySQL)

### **Frontend**
- **HTML5** (Semantic structure)
- **CSS3** (Custom styling and theme support)
- **JavaScript (ES6+)** (REST API consumption and DOM manipulation)

---

## Features

- **User Authentication**: New user registration and secure login with JWT token issuance and validation.
- **Task Management**:
  - Create tasks with title and description.
  - List all active and completed tasks.
  - Mark tasks as completed or update task details.
- **Task Filtering**:
  - General overview (*All Tasks*).
  - Dedicated filter for completed tasks (*Completed Tasks*).
- **Interface Customization**:
  - Theme toggle (*Dark Mode* / *Light Mode*).
  - Collapsible/expandable sidebar menu.

---

## Interface Overview (Screenshots)

> **Repository Note:** Upload the screenshots to a folder in the project (e.g., `docs/screenshots/` or `assets/`) and update the image paths below.

---

### 1. User Registration Screen (*Sign Up*)
<img width="1366" height="768" alt="Captura de Tela (24)" src="https://github.com/user-attachments/assets/1258116e-6441-4038-b59e-81a8850e80e2" />

- **Description**: Centered screen featuring the "REGISTER" form with Name, Email, Password, Confirm Password fields, and a submit button in light theme.

---

### 2. Login Screen (*Sign In*)
<img width="1366" height="768" alt="Captura de Tela (23)" src="https://github.com/user-attachments/assets/b50b3a4a-9d74-4237-8c3f-0bba50b4516e" />

- **Description**: Centered screen featuring the "LOGIN" form with Email and Password fields, a blue login button, and a link to registration.

---

### 3. Main Dashboard — All Tasks (*Light Theme*)
<img width="1366" height="768" alt="Captura de Tela (22)" src="https://github.com/user-attachments/assets/e2844fff-27c7-4069-af03-467026d664f6" />

- **Description**: "All Tasks" overview with an expanded sidebar menu (displaying "Tasks - Make it ease", "Home", and "Completed"), showing cards for active and completed tasks with status indicator borders and a creation button (+).

---

### 4. Completed Tasks (*Light Theme*)
*(Replace with screenshot of the completed tasks tab in light theme)*
<img width="1366" height="768" alt="Captura de Tela (21)" src="https://github.com/user-attachments/assets/6e76dce1-3838-41e0-86cc-aaff267e020f" />

- **Description**: "Completed Tasks" screen in light mode displaying only cards for tasks that have already been marked as finished.

---

### 5. Main Dashboard — All Tasks (*Dark Theme*)
*(Replace with screenshot of the main dashboard in dark theme)*
<img width="1366" height="768" alt="Captura de Tela (19)" src="https://github.com/user-attachments/assets/02bdea24-83ce-4b74-8a71-4133d1098fd7" />

- **Description**: "All Tasks" view in Dark Mode, featuring a collapsed sidebar with navigation icons and an active theme switcher in the bottom left corner.

---

### 6. Task Creation Modal (*New Task - Dark Mode*)
*(Replace with screenshot of the new task modal form)*
<img width="1366" height="768" alt="Captura de Tela (18)" src="https://github.com/user-attachments/assets/e6b7de05-c29a-4393-8fa9-c9327752c214" />

- **Description**: Overlay modal on the "NEW TASK" screen in dark theme featuring "Title" and "Description" fields, along with "CANCEL" (red) and "CREATE" (blue) buttons.

---

### 7. Completed Tasks (*Dark Theme*)
*(Replace with screenshot of the completed tasks tab in dark theme)*
<img width="1366" height="768" alt="Captura de Tela (20)" src="https://github.com/user-attachments/assets/e388e8b0-5e0b-4001-a074-ffcfa97bea0c" />

- **Description**: Dedicated view of completed tasks ("Completed Tasks") in dark theme.

---

## API Documentation (Endpoints)

All authenticated requests require a Bearer JWT Token passed in the HTTP Authorization header:
`Authorization: Bearer <your_jwt_token>`

### Authentication Controller (`/auth`)

| Method | Endpoint | Description | Request Body | Status Codes | Auth Required |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `POST` | `/auth/signup` | Registers a new user account | `SignUpRequest` | `200 OK`, `400 BAD REQUEST`, `409 CONFLICT` | No |
| `POST` | `/auth/signin` | Authenticates user and issues JWT token | `SignInRequest` | `200 OK`, `400 BAD REQUEST`, `404 NOT FOUND`, `406 NOT ACCEPTABLE` | No |

---

### Task Controller (`/tasks`)

| Method | Endpoint | Description | Request Body | Status Codes | Auth Required |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/tasks` | Retrieves all tasks owned by authenticated user | None | `200 OK`, `404 NOT FOUND` | Yes (JWT) |
| `POST` | `/tasks` | Creates a new task for authenticated user | `TaskRequest` | `200 OK`, `500 INTERNAL SERVER ERROR` | Yes (JWT) |
| `PUT` | `/tasks` | Updates an existing task | `TaskUpdateRequest` | `200 OK`, `404 NOT FOUND` | Yes (JWT) |

---

### User Controller (`/users`)

| Method | Endpoint | Description | Request Body | Status Codes | Auth Required |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/users` | Lists all registered system users | None | `200 OK`, `404 NOT FOUND` | Yes (JWT) |
| `GET` | `/users/me` | Fetches details of current authenticated user | None | `200 OK`, `404 NOT FOUND` | Yes (JWT) |

---

## How to Run the Project

### Prerequisites
- **Java JDK 17+**
- **Maven**
- Modern Web Browser (Chrome, Edge, Firefox, etc.)

### 1. Clone the repository
```bash
git clone https://github.com/ferdinaldopelembe/fasks.git
cd fasks
```

### 2. Run Backend (Spring Boot)
```bash
./mvnw spring-boot:run
```
The REST API runs by default on http://localhost:8080.

### 3. Run Frontend
- Open frontend/app/auth/signin/signin.html directly in your browser or run it using Live Server in VS Code.
