# Post-call Transcription System (Laravel + Twilio)

A small Laravel application that receives Twilio call recordings and automatically creates searchable transcriptions after each call.  
This repo demonstrates how to accept Twilio webhook events, download recordings, run transcription (Twilio Speech-to-Text or a custom service), and store transcripts in a database for later review.

---

## Table of Contents

- [Features](#features)  
- [Requirements](#requirements)  
- [Quickstart](#quickstart)  
- [Configuration](#configuration)  
- [How it works](#how-it-works)  
- [Database & Queues](#database--queues)  
- [Testing Webhooks Locally](#testing-webhooks-locally)  
- [Sample Endpoint & Controller](#sample-endpoint--controller)  
- [Security & Secrets](#security--secrets)  
- [Troubleshooting](#troubleshooting)  
- [Contributing](#contributing)  
- [License](#license)  
- [Acknowledgements](#acknowledgements)

---

## Features

- Accept Twilio call status / recording webhooks
- Download call recordings from Twilio when available
- Send recording to Twilio Speech-to-Text (or queue for external transcription)
- Store call metadata and transcription text in the database
- Basic UI (or API endpoints) to view calls and transcripts
- Background processing with Laravel Queues for reliability

---

## Requirements

- PHP 8.1+ (compatible with Laravel 11)
- Composer
- Node.js & npm (only if JS assets are used)
- A database (MySQL, PostgreSQL, SQLite)
- Laravel 11 app scaffolded
- A Twilio account (Account SID, Auth Token)
- A publicly accessible webhook URL (Ngrok for local dev)

---

## Quickstart

### **Clone the repo**
   ```bash
   git clone https://github.com/yourusername/post-call-transcription-system.git
   cd post-call-transcription-system
### composer install
  npm install       # optional (if you use front-end build)
### cp .env.example .env
### then edit .env with your values
php artisan key:generate
php artisan migrate
php artisan storage:link
 php artisan serve
### and run queue worker if you use queues:
php artisan queue:work

