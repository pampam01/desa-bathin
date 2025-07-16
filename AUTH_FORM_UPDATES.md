# Auth Form Updates - Portal Parakan

## Overview
This document outlines the changes made to align the authentication forms with the `users` table structure in the database.

## Database Structure

### Users Table Fields
Based on the migration file `0001_01_01_000000_create_users_table.php`, the users table has the following structure:

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');                    // User's full name
    $table->string('email')->unique();         // User's email (unique)
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');                // Hashed password
    $table->enum('role', ['masyarakat', 'admin'])->default('masyarakat');
    $table->rememberToken();
    $table->timestamps();
});
```

## Form Field Mapping

### Registration Form (`registrasi.blade.php`)
The registration form now includes all required fields:

| Form Field | Database Field | Type | Required | Validation |
|------------|---------------|------|----------|------------|
| `name` | `name` | string | Yes | Required, max:255 |
| `email` | `email` | email | Yes | Required, email, unique:users |
| `password` | `password` | password | Yes | Required, min:8, confirmed |
| `password_confirmation` | - | password | Yes | Required for confirmation |
| `role` | `role` | select | Yes | Required, in:masyarakat,admin |
| `terms` | - | checkbox | Yes | Required for terms acceptance |

### Login Form (`login.blade.php`)
The login form uses the following fields:

| Form Field | Database Field | Type | Required | Validation |
|------------|---------------|------|----------|------------|
| `email` | `email` | email | Yes | Required, email |
| `password` | `password` | password | Yes | Required, min:8 |
| `remember` | - | checkbox | No | Optional for "Remember Me" |

## Changes Made

### 1. Updated User Model
- Added `role` field to the `$fillable` array in `app/Models/User.php`

### 2. Updated AuthController
- Added proper validation for registration and login
- Added `register()` method for handling user registration
- Added proper error handling and localized messages
- Added role-based redirects after authentication

### 3. Updated Routes
- Added POST route for registration: `Route::post('/register', [AuthController::class, 'register'])->name('register.store')`
- Added routes for terms, privacy policy, and password reset

### 4. Updated Form Structure
- **Registration Form**: Uses `name`, `email`, `password`, `password_confirmation`, `role`, and `terms` fields
- **Login Form**: Uses `email`, `password`, and `remember` fields
- Added proper Laravel validation with error display
- Added CSRF protection
- Added old input preservation for failed submissions

### 5. Form Validation Messages
Custom validation messages in Indonesian:
- `name.required` → "Nama lengkap harus diisi."
- `email.unique` → "Email sudah terdaftar."
- `password.min` → "Password minimal 8 karakter."
- `password.confirmed` → "Konfirmasi password tidak cocok."
- `role.required` → "Peran harus dipilih."
- `terms.required` → "Anda harus menyetujui syarat dan ketentuan."

## Role-based Features

### User Roles
- **masyarakat**: Regular users (default)
- **admin**: Administrative users

### Registration Role Selection
Users can choose their role during registration:
- "Masyarakat" for regular village residents
- "Admin" for system administrators

### Post-login Redirects
- **Admin users**: Redirected to `/dashboard`
- **Regular users**: Redirected to `/` (home page)

## Security Features

### Password Security
- Minimum 8 characters required
- Passwords are hashed using Laravel's `Hash::make()`
- Password confirmation required during registration

### Session Management
- CSRF protection on all forms
- Session regeneration on login
- "Remember Me" functionality
- Proper session cleanup on logout

### Form Validation
- Server-side validation for all fields
- Client-side password confirmation validation
- Terms and conditions acceptance required

## File Structure

### Auth Views
```
resources/views/auth/
├── layouts/
│   └── app.blade.php              # Main auth layout
├── partials/
│   ├── head.blade.php             # Head section
│   ├── scripts.blade.php          # Script section
│   └── logo.blade.php             # Logo partial
├── login.blade.php                # Login form (updated)
├── registrasi.blade.php           # Registration form (updated)
└── register.blade.php             # Alternative registration (using partials)
```

### Controllers
```
app/Http/Controllers/
└── AuthController.php             # Updated with proper authentication logic
```

### Models
```
app/Models/
└── User.php                       # Updated with role field in fillable
```

## Usage Examples

### Registration
```php
// POST /register
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "masyarakat",
    "terms": "on"
}
```

### Login
```php
// POST /login
{
    "email": "john@example.com",
    "password": "password123",
    "remember": "on"  // optional
}
```

## Migration Notes

### Database Migration
No additional migrations required - the users table structure already supports all required fields.

### Existing Data
If there are existing users without the `role` field, they will default to 'masyarakat' as specified in the migration.

## Testing Checklist

- [ ] Registration form validates all fields correctly
- [ ] Login form authenticates users properly
- [ ] Role-based redirects work correctly
- [ ] Password confirmation validation works
- [ ] Terms acceptance is required
- [ ] Error messages display properly
- [ ] CSRF protection is working
- [ ] Session management is secure
- [ ] "Remember Me" functionality works
- [ ] Email uniqueness validation works

## Future Enhancements

1. **Email Verification**: Add email verification process
2. **Password Reset**: Implement password reset functionality
3. **Two-Factor Authentication**: Add 2FA support
4. **Social Login**: Add social media login options
5. **Profile Management**: Add user profile editing
6. **Role Management**: Add admin interface for role management
