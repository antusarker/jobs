## Project Name: HireSmart
## PHP Version: 8.2
## Project Setup
```bash
git clone https://github.com/antusarker/jobs.git
cd /jobs
composer install
```

## JWT Applied for
- **[Login]**
- **[Registration(Employer/Candidate)]**
- **[GetCurrentUser]**
- **[Logout]**

## Role-Based Access Control
This project uses Laravel 11 with Breeze for authentication, and implements user role-based access to manage permissions and route visibility.

## User Roles
- **[Admin] : Has full access to all system features and management tools.**
- **[Employer] : Can post jobs, view applicants, and manage job listings.**
- **[Candidate] : Can browse jobs, receive job alerts, and apply to postings.**

## Key Features
- **[Breeze-Authentication] : Lightweight and modern scaffolding for login, registration, and password management.**
- **[Role-Middleware] : Custom middleware restricts route access based on user role.**
- **[Clean-Architecture] : Routes, controllers, and views are structured by role for easy maintenance and scalability. Service & Repositopry Pattern Applied**

## JobMatch Alert System
is a real-time notification feature designed to instantly inform candidates about new job opportunities that align with their profiles.

Current Features:
Database Notifications
Candidates receive in-app alerts whenever a job matching their location and expected salary is posted.

Future Implementation:
Real-Time Updates via Pusher
Integration with Pusher will enable instant, real-time delivery of notifications without needing to refresh the page.

## Archive Old Jobs & Remove Unverified Users (Scheduled Tasks)

Scheduled tasks are defined in the project to automate:
- **Archiving job posts older than 30 days**
- **Removing unverified users**

## In Development
You can manually run the Laravel scheduler:
- **php artisan schedule:run**

## In Production
In production, Laravel's scheduler must be triggered **daily** using a system-level cron job.
Add this to your system’s crontab to enable automatic scheduling:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Rate-limit
- **Applied to Login Attempts**
- **Applied to Candidate Job Application Submissions**
