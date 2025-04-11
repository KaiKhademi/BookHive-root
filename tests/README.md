# 📦 BookHive PHPUnit Test Suite

This directory contains unit tests for the core and optional functionalities of the **BookHive** virtual library platform.

Each test uses **PHPUnit** to validate functionality and ensure reliability of database interactions.

---

## ✅ Core Tests

### `SignupTest.php`
- Verifies that a new user can successfully register
- Uses a unique email/username combo
- Checks that the user is inserted and gets a valid `user_id`

### `SigninTest.php`
- Confirms login behavior using known credentials
- Hashes the password and checks with `password_verify`
- Validates session-like authentication behavior

### `ThreadTest.php`
- Tests thread creation using a valid test user
- Verifies insertion into the `threads` table

---

## 🧪 Other Tests

### `ProfileTest.php`
- Tests updating a user's email address
- Confirms the update was successful in the database

### `AddBookTest.php`
- Tests insertion of a book record into the `books` table
- Assumes `title`, `author`, and `user_id` fields

### `AdminTest.php`
- Simulates an admin deleting a user from the database
- Validates the deletion was successful

---

## 🧪 Running the Tests

To run all tests:
```bash
phpunit
```



