# Plan: Claim Request Flow & Chat Removal

This document outlines the changes required to replace the direct chat system with a request-based "Claim & Contact" workflow.

## 1. Objectives
- Remove the "Messages/Chat" functionality entirely.
- Implement a structured "Claim Request" system.
- Allow owners to share their contact info only after a claim is initiated.
- Provide an interface for users to Accept/Reject claims on their items.

## 2. Structural Changes

### A. UI Reductions (Removal of Chat)
- **Navbar & Sidebar:** Remove "Messages" link.
- **Dashboard:** Remove "Unread Messages" KPI box.
- **Item Detail:** Remove "Message" button.

### B. New Claim Workflow
1. **Item Detail Page (`item-detail.php`):**
   - User clicks "Claim This Item".
   - A **Modal** pops up showing:
     - "Owner's Contact: [Phone Number]" (Blurred until claim is submitted, or shown directly as requested).
     - Textarea: "Provide proof or details to verify ownership".
     - Button: "Send Claim Request".
2. **Database Update (`claims` table):**
   - Use the existing `claims` table to track status (`pending`, `approved`, `rejected`).
3. **Owner Dashboard (`dashboard.php`):**
   - New section: **"Pending Claims on Your Items"**.
   - Show claimant name, item title, and proof provided.
   - Action Buttons: **[Accept]** and **[Reject]**.

### C. Logic for Accept/Reject
- **Accept:** 
  - Update `claims.status` to 'approved'.
  - Update `items.status` to 'returned' or 'matched'.
- **Reject:**
  - Update `claims.status` to 'rejected'.
  - Item remains 'active' for others to claim.

## 3. Implementation Steps

1. **[DOCS]** Save this plan (Done).
2. **[DATABASE]** Ensure `claims` table has necessary fields (Status, Proof, Claimant ID).
3. **[API]** Create `api/handle_claim.php` to process Accept/Reject actions.
4. **[UI]** Modify `item-detail.php` to include the Claim Modal and remove Message buttons.
5. **[UI]** Update `dashboard.php` to replace "Messages" with a "Claim Management" area.
6. **[CLEANUP]** Delete or disable `messages.php` and `api/send_message.php`.

## 4. Verification
- Test claiming an item as a different user.
- Verify owner sees the claim request on their dashboard.
- Verify that clicking "Accept" updates the item status to 'Returned'.
