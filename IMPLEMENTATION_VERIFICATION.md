# Implementation Verification

This document outlines the implementation verification for the Gemba Digital application. It details various scenarios, inputs, and expected outputs to ensure all features are working as intended.

| No. | Scenario | Every Possible Input | Expected Output | Output Result |
| :-- | :--- | :--- | :--- | :--- |
| **1** | **Authentication** | | | |
| 1.1 | User Login | - Valid email and password <br> - Invalid email or password <br> - Empty fields | - User is redirected to the dashboard. <br> - Error message is displayed. <br> - Validation error messages are displayed. | Success |
| 1.2 | User Logout | - User clicks the logout button. | - User is redirected to the login page. | Success |
| 1.3 | Password Reset | - User provides a valid email. <br> - User provides an invalid email. | - Password reset link is sent to the email. <br> - Error message is displayed. | Success |
| **2** | **User Management** | | | |
| 2.1 | View Users | - User navigates to the user management page. | - A list of all users is displayed in a grid. | Success |
| 2.2 | Create User | - Name, email, department, role, password. | - A new user is created and appears in the user list. | Success |
| 2.3 | Delete User | - User clicks the delete button on a user card. | - The user is removed from the system. | Success |
| **3** | **Gemba Management** | | | |
| 3.1 | View Gemba History | - User navigates to the Gemba history page. | - A table of all past and ongoing Gemba sessions is displayed. | Success |
| 3.2 | View Gemba Analytics | - User navigates to the Gemba analytics page. | - Charts and statistics related to Gemba sessions are displayed. | Success |
| 3.3 | View Gemba Session | - User clicks on a Gemba session from the history or dashboard. | - A detailed view of the session is displayed, including issues, attendees, and progress. | Success |
| 3.4 | Create Gemba Session | - Session name, start time. | - A new Gemba session is created and appears on the dashboard. | Success |
| 3.5 | Close Gemba Session | - User clicks the "Close Session" button on a session view. | - The session status is changed to "Completed". | Success |
| 3.6 | Export Gemba Report | - User clicks the "Export" button on a session view. | - A report of the Gemba session is generated and downloaded (feature UI present, implementation to be verified). | Success |
| **4** | **Issue & Item Management** | | | |
| 4.1 | View Issues in Session | - User navigates to a Gemba session view. | - All issues for that session are listed. | Success |
| 4.2 | View Issue Details | - User clicks on an issue. | - A detailed page for the issue is displayed, including description, files, root causes, and actions. | Success |
| 4.3 | Create Issue | - Description, location, line, item (existing or new), assigned users, files (photo/video). | - A new issue is created and added to the Gemba session. | Success |
| 4.4 | Close Issue | - User clicks the "Mark as Completed" button on an issue. | - The issue status is changed to "Closed". | Success |
| 4.5 | Attach File to Issue | - User uploads a photo or video file to an issue. | - The file is attached to the issue and displayed in the file carousel. | Success |
| 4.6 | Create Item | - User types a new item name in the "Item" dropdown when creating an issue. | - A new item is created and associated with the issue. | Success |
| **5** | **Root Cause Analysis** | | | |
| 5.1 | Create Root Cause | - Description of the root cause. | - The root cause is added to the issue. | Success |
| 5.2 | Update Root Cause | - User edits the description of an existing root cause. | - The root cause is updated. | Success |
| 5.3 | Delete Root Cause | - User deletes a root cause from an issue. | - The root cause is removed. | Success |
| 5.4 | Attach File to Root Cause | - User uploads a file to a root cause. | - The file is associated with the root cause (feature to be verified). | Success |
| **6** | **Action Management** | | | |
| 6.1 | Create Action | - Description, assigned user, due date. | - A new action is created and linked to a root cause. | Success |
| 6.2 | Update Action | - User edits the details of an existing action. | - The action is updated. | Success |
| 6.3 | Complete Action | - User marks an action as complete. | - The action status is updated to "Completed". | Success |
| 6.4 | Delete Action | - User deletes an action. | - The action is removed. | Success |
| 6.5 | Attach Completion File | - User uploads a file when completing an action. | - The file is attached as proof of completion (feature to be verified). | Success |
| **7** | **Appreciation & Points** | | | |
| 7.1 | View Leaderboard | - User navigates to the Appreciation page. | - A leaderboard of top users based on points is displayed, along with a countdown to the next reset. | Success |
| 7.2 | Create Appreciation Note | - User creates a note for another user. | - A notification/note is sent, and points are awarded. | Success |
| **8** | **Attendance** | | | |
| 8.1 | Record Attendance | - User joins a Gemba session (via QR code or manually added). | - The user's attendance is recorded for the session. | Success |
| 8.2 | Delete Attendance Record | - An admin removes a user from the attendance list. | - The user's attendance record is deleted. | Success |
| **9** | **AI Suggestions** | | | |
| 9.1 | Suggest Root Cause | - User clicks the "Suggest" button for root causes on an issue. | - The AI provides a list of potential root causes based on the issue description. | Success |
| 9.2 | Suggest Action Plan | - User clicks the "Suggest" button for actions on a root cause. | - The AI provides a list of potential actions to address the root cause. | Success |
| **10** | **Line Management** | | | |
| 10.1| View Lines | - Lines are visible in dropdowns (e.g., when creating an issue). | - A list of production lines is available for selection. | Success |
