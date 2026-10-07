# Blood Bank Donor & Stock Manager

## Project report

**Student name:** ____________________  
**Register number:** ____________________  
**Class / section:** ____________________  
**College:** ____________________  
**Faculty:** ____________________  
**Academic year:** ____________________

## Abstract

Blood Bank Donor & Stock Manager is an educational web application that demonstrates how a small blood bank could organize donor records, blood group stock counts, and incoming requests. The first stage is a static HTML, CSS, and JavaScript prototype. The second stage uses PHP and MySQL to persist records. All included records are fictional; the project is not intended for medical or operational use.

## Introduction and problem statement

For a classroom example, donor details, stock levels, and requests are often shown in separate lists. This makes it harder to demonstrate how the information relates. This project brings those sample workflows into one simple dashboard so a user can see stock levels, manage donor records, and track request status.

## Objectives and scope

- Build a responsive static prototype with client-side interactions.
- Extend the prototype with PHP and MySQL persistence.
- Demonstrate donor create, read, update, and delete operations.
- Track sample stock for eight blood groups and flag low levels.
- Record fictional requests and update their workflow status.

Out of scope: real donor eligibility, medical matching, collection operations, laboratory results, live inventory, authentication, and clinical decisions.

## Existing and proposed system

The classroom scenario begins with disconnected sample lists and manual status tracking. The proposed demo provides a shared dashboard and CRUD screens. It is a learning aid, not a production blood bank system.

## Requirements

### Functional

- Show donor, stock, low-stock, and pending-request summaries.
- Add, search, edit, and delete donor records.
- Display and update all eight blood group unit counts.
- Record requests and update them as Pending, Approved, or Fulfilled.

### Non-functional

- Responsive interface with readable labels and feedback.
- Server-side validation, output escaping, prepared SQL statements, and CSRF tokens.
- Beginner-readable file structure and local setup.

## Hardware and software requirements

- Computer with a modern browser.
- XAMPP or equivalent local Apache, PHP, and MySQL installation for Stage 2.
- Any text editor for reviewing the source.

## Architecture and modules

The browser renders HTML styled with CSS and enhanced with JavaScript. Stage 1 uses fictional in-memory data. Stage 2 sends form submissions to PHP pages. PHP validates input and uses PDO prepared statements to read or update MySQL. Shared layout and helper functions are in `includes/` and `config.php`.

Modules: Dashboard, Donor directory, Blood stock, Request desk, and About/scope.

## Database design

- **donors:** `id` primary key; name, blood group, phone, city, optional last donation date, and creation time.
- **blood_stock:** blood group primary key; available unit count, low-stock threshold, and update time.
- **blood_requests:** `id` primary key; requester, blood group, requested units, contact, organization, status, and creation time.

The request and donor rows use blood-group values constrained to the eight accepted groups. The demo keeps request records independent from stock transactions; it does not reserve or deduct inventory.

## Implementation summary

Stage 1 is in `stage-1-static/` and can be opened directly in a browser. Stage 2 is in `stage-2-dynamic/` and uses PHP, MySQL, PDO, shared includes, server-side validation, escaped output, and CSRF tokens. Import `stage-2-dynamic/database/blood_bank.sql` before opening the dynamic site.

## Verification checklist

This checklist describes expected behavior; mark each item after you try it locally.

- [ ] Stage 1 pages and navigation display on a desktop and phone-sized viewport.
- [ ] Stage 1 donor and request forms add fictional rows during the current browser session.
- [ ] Stage 2 dashboard loads after importing the SQL file.
- [ ] A donor can be added, edited, found by search, and deleted.
- [ ] Stock accepts non-negative whole numbers and shows low-stock groups.
- [ ] A request can be added and its status changed.
- [ ] Invalid form values are rejected with a helpful message.

## Limitations and future enhancements

The demo has no user login or role management. It does not store blood collection or expiry batches, enforce operational workflows, or deduct inventory on fulfillment. Future classroom enhancements could add login roles, audit history, batch and expiry tracking, reports, and automated tests after defining safe business rules.

## Conclusion

The project demonstrates a complete progression from a static interface to a PHP/MySQL application for a fictional use case. It provides practice with responsive design, forms, CRUD operations, database access, and basic web security.

## References

- PHP documentation: https://www.php.net/docs.php
- MySQL documentation: https://dev.mysql.com/doc/
- MDN Web Docs: https://developer.mozilla.org/
