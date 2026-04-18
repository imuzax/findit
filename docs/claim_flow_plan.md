# 🏆 FindIt: Item Claim & Resolution Flow Implementation Plan

This document outlines the business logic and phased execution for handling claims on the Lost & Found platform. 

## 🧠 Business Logic & Visibility Matrix

### 1. Public Viewing (Guests)
- **Visibility:** Anyone (logged in or out) can browse the home page and view item details (`index.php`, `item-detail.php`).
- **Actions Allowed:** None. 
- **Button Displayed:** `Login to Claim / Contact Owner` -> Redirects to `auth.php`.

### 2. The Original Owner (The person who posted the item)
- **Visibility:** Can view their own item detail.
- **Actions Allowed:** Cannot "Claim" their own item. They have resolution powers.
- **If POSTED "LOST":** Button displayed -> `Mark as Found / Recovered`. (Used when they recover the item).
- **If POSTED "FOUND":** Button displayed -> `Mark as Returned`. (Used when they successfully hand the item back).

### 3. Logged In User (Looking at someone else's post)
- **Visibility:** Can view item details.
- **If VIEWING "LOST":** Button displayed -> `I Found This (Contact Owner)`.
- **If VIEWING "FOUND":** Button displayed -> `This is Mine (Claim Item)`.

### 4. Once Marked as Resolved
- The item stays on the public website but the "Status" permanently changes to `Recovered` or `Returned`.
- **All action buttons are permanently removed** (no one can claim it anymore).

---

## 🛠️ Phases of Execution

### Phase 1: Dynamic Data Binding & Public Access
- Ensure `index.php` shows latest items from DB purely publicly.
- Refactor `item-detail.php` to fetch live data using `?id=X` from the URL.

### Phase 2: Contextual Button Logic (item-detail.php)
- Implement PHP logic to check `$_SESSION['user_id']` against the item's `user_id`.
- Render the 4 different button states outlined in the matrix (Login, Claim, Contact, Resolve).

### Phase 3: Action Execution APIs
- Create `api/claim_item.php`: Takes user request to claim something and creates a `claims` record in the database.
- Create `api/resolve_item.php`: Allows the item owner to permanently close the record, changing its status.

### Phase 4: Connecting the Frontend
- Tie the buttons on `item-detail.php` to the new Javascript `fetch` calls.
