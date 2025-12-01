# wild-camper
Wildcamper is a school project developed for EFP, offering a unique vehicle rental service designed for all conditions, including overnight stays. Whether you're an outdoor enthusiast, a road trip lover, or simply seeking an adventurous getaway, Wildcamper provides the perfect solution for exploring the great outdoors with comfort and convenience.

## Features

- **Vehicle Rental System**: Browse and book adventure vehicles
- **Admin Back Office**: Manage vehicles, categories, and featured listings
- **User Authentication**: Secure login system with role-based access
- **Responsive Design**: Mobile-friendly interface with burger menu
- **Database Integration**: Supabase (PostgreSQL) with automatic REST API, or MySQL/MariaDB for legacy support

## Admin Access

### Login
- URL: `/public/login.php`
- Default admin credentials (from database):
  - Username: `admin`
  - Password: `mot_de_passe_admin`

### Back Office
- URL: `/public/admin.php` (requires admin login)
- Features:
  - View all vehicles
  - Add new vehicles
  - Edit vehicle details (name, description, price, availability, featured status)
  - Delete vehicles
  - Manage categories

### Password Migration
If passwords are stored in plain text, run the migration script once:
```bash
php public/hash-passwords.php
```
**Important**: Delete this file after running it for security reasons.

## Database Setup

The project uses **Supabase** (PostgreSQL) running locally in Docker. MySQL/MariaDB is kept for legacy compatibility but Supabase is the default.

### Supabase (Default)

Supabase runs locally in Docker containers and provides:
- PostgreSQL database
- REST API automatically generated
- Admin interface (Studio) at http://localhost:8082
- Authentication system

**Access:**
- **Supabase Studio**: http://localhost:8082 (admin interface)
- **API URL**: http://localhost:8000
- **PostgreSQL**: localhost:54322

### MySQL (Legacy - Optional)

To use MySQL instead of Supabase, set `USE_SUPABASE=false` in your environment variables.

**Default MySQL Credentials:**
- Host: `db` (from container) or `localhost` (from host)
- Database: `wildcamper`
- User: `wildcamper`
- Password: `wildcamper123`
- phpMyAdmin: http://localhost:8081

## Project Structure

```
wild-camper/
├── config/
│   └── database.php          # Database configuration
├── database/
│   └── backup/
│       └── wldcamper.sql     # Database schema and initial data
├── public/
│   ├── components/           # Reusable PHP components
│   ├── login.php            # Login page
│   ├── admin.php            # Admin back office
│   └── logout.php           # Logout handler
├── style/                    # CSS stylesheets
└── index.php                # Main router
```
