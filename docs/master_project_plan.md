# FindIt: Lost & Found Platform - Master Project Plan
**Project Level:** BCA Major Project
**Current Status:** Under Development

This document serves as the master checklist and architecture guide for the "FindIt" project. It is written in simple, easy-to-understand terms so that all team members and partners can track the core completed features and what remains to be built.

---

## 1. Authentication Module 
*Objective: Allow users to securely register, login, and manage their sessions.*
- [x] **Database Setup:** `users` table with hashed passwords.
- [x] **Registration Page:** Collect Name, Email, Password.
- [x] **Login Page:** Verify credentials and start secure PHP session.
- [x] **Logout functionality:** Safely destroy sessions.

## 2. Item Reporting Module (Lost / Found)
*Objective: Allow users to easily post items they have lost or found.*
- [x] **Reporting Form UI:** Clean page (`post-lost.php`) with categories, colors, dates, and map inputs.
- [x] **Image Uploads:** Users can attach visuals (up to 5MB, multiple files) to their reports.
- [x] **Live Image Preview:** Preview thumbnails before clicking submit.
- [x] **Database Integration:** Insert records into `items` array and upload photos into `item_images` / Local directory.

## 3. Browsing & Searching Module
*Objective: Enable anyone (even those not logged in) to view lost and found items.*
- [x] **Public Timeline / Homepage:** Show recent items beautifully on `index.php`.
- [x] **Browse Page:** Grid layout to show all active items (`browse.php`).
- [x] **Search & Filters:** Ability to filter items by Category, Date, or "Lost vs Found" status.

## 4. Item Detail & Action Module
*Objective: View deep details of a specific item and interact with it.*
- [x] **Detail View (`item-detail.php`):** Large image gallery, descriptive tags, and reported date.
- [x] **Visual Lifecycle Status:** Shows "Returned" or "Active" banners.
- [x] **Claim / Contact Owner Button:** Intelligent button logic that hides if you own it, or shows "Login to Claim" if logged out.

## 5. Claims & Resolution Workflow
*Objective: Create a bridge for the original owner and the finder to connect.*
- [x] **Submit Claim:** Users can click "Claim Item" and have it insert into the `claims` database table.
- [x] **Owner Resolution Action:** Item poster can click "Mark as Found/Recovered", which formally changes item status to `returned` in the database.
- [x] **Claim Dashboard Management:** Allow the item poster to see *who* specifically claimed their item inside the `dashboard.php` and "Approve" or "Reject" them.

## 6. Real-Time Messaging Module (Optional / Phase 2)
*Objective: A built-in chat so users don't have to share personal WhatsApp/Phone numbers.*
- [x] **Database Structure:** `messages` table created.
- [x] **API Infrastructure:** Endpoints to send and receive messages in the background.
- [x] **Live Chat UI:** Dynamic chat layout.
- [ ] **Integration:** Re-enable the connection between claiming an item and starting the chat thread. (Paused per user request, can turn on later easily).

## 7. User Dashboard Module
*Objective: A private hub where users can see their own data.*
- [x] **Dashboard UI:** Greeting, Statistics overview.
- [x] **My Reports List:** See all items that *I* have posted (`items` table).
- [x] **My Active Claims:** See the status of items *I* have claimed.
- [x] **Pending Approvals:** See people who want to claim the things *I* posted.

## 8. Final Polish & Deployment Preparation
*Objective: Ensure it's college presentation ready.*
- [x] **Database Seed/Mock Data:** Enter 10-15 solid dummy items (bikes, wallets, keys) to make the platform look alive.
- [ ] **Responsive Testing:** Check if it works perfectly on mobile views.
- [ ] **Blackbook Screenshots:** Take screenshots of every feature for the final report.

---

### How to Use This File:
- Whenever we finish a major piece of functionality, we change `[ ]` to `[x]`.
- This ensures everything is organized, and you can simply send this Markdown file to your partner or guide to showcase progress!
