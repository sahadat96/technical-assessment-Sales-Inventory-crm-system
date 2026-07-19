# Sales, Inventory & CRM Management System

A Laravel 13 RESTful API for managing Sales, Inventory, CRM, Employee KPI, and Multi-Branch operations.

---

# Features

## Authentication

- JWT Authentication
- User Registration
- User Login
- Refresh Access Token
- Protected APIs

---

## Product Management

- Product Create
- Soft Delete
- SKU Validation
---

## Customer Management

- Customer Purchase History
- Purchase Frequency
- Last Purchase Date

---

## Sales Management

- Create Sales
- Sale Items
- Payment Method
- Payment Status
- Tax
- Discount
- Automatic Total Calculation

---

## Inventory Management

- Branch-wise Inventory
- Automatic Stock Deduction
- Inventory Transaction History
- Stock Validation
- Prevent Overselling

---

## CRM

### Lost Customer Detection

Customers with no purchases within the configured inactivity period (90 days).

### Customer Re-engagement

- Email Campaign
- SMS (Structure Ready)
- Queue-based Email Sending

### Customer Assignment

- Assign Lost Customers to Employees
- Assignment Status
- Follow-up Tracking

---

## Employee KPI

Automatically rewards employees when an assigned inactive customer returns and makes a purchase.

---

## Multi Branch Support

- Branch Management
- Branch-wise Inventory
- Branch-wise Sales
- Branch Inventory Tracking

---

## API Resources

- Resource Classes
- Request Validation
- Service Layer Architecture
- Clean JSON Responses

---

# Tech Stack

- Laravel 13
- PHP 8.4+
- MySQL
- JWT Authentication
- Queue
- Mail
- REST API

---

# Project Architecture

```
Controller
      │
      ▼
Request Validation
      │
      ▼
Service Layer
      │
      ▼
Models
      │
      ▼
Database
      │
      ▼
API Resource
```

Business logic is implemented inside the Service layer.

Controllers remain thin.

---

# Installation

Clone the repository

```bash
git clone https://github.com/sahadat96/technical-assessment-Sales-Inventory-crm-system.git
```

Go to project

```bash
cd technical-assessment-Sales-Inventory-crm-system.git
```

Install dependencies

```bash
composer install
```

Copy environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Generate JWT Secret

```bash
php artisan jwt:secret
```

---

# Environment Configuration

Configure your `.env`

```env
APP_NAME="Sales CRM"

APP_ENV=local

APP_DEBUG=true

APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=sales_inventory

DB_USERNAME=root

DB_PASSWORD=

QUEUE_CONNECTION=database

MAIL_MAILER=smtp

MAIL_HOST=smtp.gmail.com

MAIL_PORT=587

MAIL_USERNAME=email@gmail.com

MAIL_PASSWORD=app-password

MAIL_ENCRYPTION=tls

MAIL_FROM_ADDRESS=email@gmail.com

MAIL_FROM_NAME="Sales CRM"
```

---

# Database

Create database

```
sales_inventory
```

Run migrations

```bash
php artisan migrate
```

---

# Seed Database

Run all seeders

```bash
php artisan db:seed
```

---

# Queue

Start Queue Worker

```bash
php artisan queue:work
```

---

# Run Project

```bash
php artisan serve
```

API

```
http://127.0.0.1:8000
```

# Business Rules

## Sales

- Product must be active.
- Branch inventory must exist.
- Stock cannot be negative.
- Sale and Inventory are transactional.
- Automatic stock deduction.
- Automatic inventory transaction creation.

---

## CRM

- Detect lost customers.
- Assign lost customers to employees.
- Send promotional emails.
- Track communication history.

---

## Employee KPI

When an assigned inactive customer makes a purchase:

- Create KPI record
- Award employee points
- Mark assignment as completed

---

# Sample Seed Data

Seeders generate realistic:

- Customers
- Branches
- Branch Inventory

The project is immediately testable after running:

```bash
php artisan migrate:fresh --seed
```

---

# Mail

Email notifications use Laravel Mail.

Supported:

- SMTP
- Gmail
- Mailtrap

Queue supported.

---

# Queue Jobs

- SendPromotionJob

---

# Design Principles

- SOLID Principles
- Service Layer Pattern
- Resource Classes
- Form Requests
- Database Transactions
- Dependency Injection
- Repository-ready Structure
- Clean JSON Responses

---

# Evaluation Criteria Covered

- Clean Architecture
- Layered Design
- RESTful API
- Database Normalization
- Business Logic
- Inventory Control
- CRM Module
- Employee KPI
- Multi-Branch Support
- JWT Authentication
- Queue Processing
- Mail Integration
- Laravel Best Practices

---

# Author

Sahadat Hossain

Backend Developer

Laravel • PHP • MySQL
