# Implementation Verification

This document outlines the detailed test cases for the Gemba Digital application, covering all features, user interactions, and expected outcomes. It is designed to ensure comprehensive testing and verification of the application's functionality.

## 1. Authentication

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **User Login** | 1. Navigate to the login page. <br> 2. Enter a valid email and password. <br> 3. Click the "Login" button. | 1. The user is successfully authenticated. <br> 2. The user is redirected to the main dashboard. <br> 3. A session is created for the user. |
| 2 | **Invalid Login** | 1. Enter an invalid email or password. <br> 2. Click "Login". | 1. An error message, "Invalid credentials," is displayed. <br> 2. The user remains on the login page. |
| 3 | **User Logout** | 1. Click on the user profile dropdown. <br> 2. Select "Logout." | 1. The user session is terminated. <br> 2. The user is redirected to the login page. |
| 4 | **Forgot Password** | 1. Click "Forgot Password" on the login page. <br> 2. Enter a valid email address. | 1. A password reset email is sent to the user's email address. <br> 2. The email contains a link with a unique token to reset the password. |

## 2. User Management (Superadmin/Admin)

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **View Users** | 1. As a superadmin or admin, navigate to the "User Management" page. | 1. A paginated list of all users is displayed. <br> 2. Each user entry shows their photo, name, email, and role. |
| 2 | **Create User** | 1. Click "Create User." <br> 2. Fill in the user's details (name, email, password, role). <br> 3. Click "Save." | 1. A new user is created in the database. <br> 2. The new user appears in the user list. <br> 3. A success toast message is displayed. |
| 3 | **Update User** | 1. Click the "Edit" button for a user. <br> 2. Modify the user's details. <br> 3. Click "Save." | 1. The user's information is updated in the database. <br> 2. The user list reflects the changes. |
| 4 | **Delete User** | 1. Click the "Delete" button for a user. <br> 2. Confirm the deletion in the modal. | 1. The user is soft-deleted from the database. <br> 2. The user is removed from the user list on the UI. |

## 3. Gemba Management

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Create Gemba Session** | 1. Navigate to "Gemba" -> "Create." <br> 2. Fill in the session details (e.g., area, date). <br> 3. Click "Start Session." | 1. A new Gemba session is created with a "progress" status. <br> 2. The user is redirected to the session's detail page. |
| 2 | **View Gemba History** | 1. Navigate to "Gemba" -> "History." | 1. A list of all past and ongoing Gemba sessions is displayed. <br> 2. Each session shows its status (e.g., progress, closed). |
| 3 | **Close Gemba Session** | 1. From a session's detail page, click "Close Session." <br> 2. Confirm the action. | 1. The session's status is updated to "closed." <br> 2. The UI reflects the change in status. |

## 4. Issue Management

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Create Issue** | 1. In a Gemba session, click "Add Issue." <br> 2. Fill in the issue details and upload an optional file. <br> 3. Click "Save." | 1. A new issue is created and linked to the Gemba session. <br> 2. The issue appears in the session's issue list. |
| 2 | **View Issue** | 1. Click on an issue in the list. | 1. A modal or detail view opens, showing the issue's description, status, and attached files. |
| 3 | **Close Issue** | 1. In the issue detail view, click "Close Issue." | 1. The issue's status is updated to "closed." |

## 5. Action Management

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Create Action** | 1. In an issue view, click "Add Action." <br> 2. Fill in the action details (description, PIC, due date). <br> 3. Click "Save." | 1. A new action is created and linked to the issue. <br> 2. The action appears in the issue's action list. |
| 2 | **Complete Action** | 1. Click the "Complete" button for an action. <br> 2. Optionally, upload a completion evidence file. | 1. The action's status is updated to "completed." <br> 2. The completion date and file are recorded. |

## 6. Root Cause Management

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Add Root Cause** | 1. In an issue view, click "Add Root Cause." <br> 2. Select a category and provide a description. <br> 3. Click "Save." | 1. A new root cause is added to the issue. <br> 2. It appears in the root cause list for that issue. |

## 7. AI-Powered Suggestions

This module provides AI-driven assistance for identifying root causes and suggesting actions.

### 7.1. AI for Root Cause Suggestion

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Request AI Root Cause Suggestions** | 1. On an issue's details page, click "Tanya AI" (Ask AI) in the "Root Cause" section. <br> 2. Select a category. | 1. A modal appears with a loading indicator. <br> 2. A POST request is sent to the AI service. <br> 3. A list of suggested root causes is displayed. |
| 2 | **Save an AI-Suggested Root Cause** | 1. Click the "Save" button next to a suggestion. | 1. The suggestion is saved as a new root cause. <br> 2. The suggestion is removed from the modal list. <br> 3. A success toast is displayed. |

### 7.2. AI for Action Suggestion

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Request AI Action Suggestions** | 1. On an issue's details page, click "Tanya AI" (Ask AI) in the "Action" section. <br> 2. Select a root cause. | 1. A modal appears with a loading indicator. <br> 2. A POST request is sent to the AI service. <br> 3. A list of suggested actions is displayed. |
| 2 | **Save an AI-Suggested Action** | 1. Click the "Save" button next to a suggestion. | 1. The suggestion is saved as a new action. <br> 2. The suggestion is removed from the modal list. <br> 3. A success toast is displayed. |

## 8. Gemba Report Generation

This module allows users to generate, view, and download PDF reports for Gemba sessions.

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Generate Gemba Report** | 1. On a Gemba session's detail page, open the report generation modal. <br> 2. Click "Generate Report." | 1. A loading indicator is shown. <br> 2. A PDF report is generated and saved. <br> 3. A new entry is created in the `genba_reports` table. <br> 4. The list of available reports is updated. |
| 2 | **View Existing Reports** | 1. Open the report modal for a session with existing reports. | 1. A list of previously generated reports is displayed. <br> 2. Clicking a link opens the PDF in a new tab. |

## 9. Analytics Dashboard

This dashboard provides an overview of key metrics and trends.

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Time-Based Filtering** | 1. On the analytics dashboard, select a time filter (All, Year, Month, Day). | 1. The data in the analytics charts (e.g., Action Donut Chart) updates to reflect the selected time scope. |
| 2 | **Comparative Stats** | 1. View the highlight statistics cards (e.g., Issues, Actions). | 1. The cards display the total count for the current month. <br> 2. A percentage comparison to the previous month is shown. |
| 3 | **Top 5 Area Ranking** | 1. View the "Area" statistic card. | 1. The card displays a ranked list of the top 5 production lines with the highest number of issues. |

## 10. Gamification & Rewards

This module includes a points system to encourage user engagement.

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Earn Points** | 1. Create and submit an "Appreciation Note" for another user. | 1. A `PointHistories` record is created. <br> 2. The recipient's point balance is updated. |

## 11. Item Management

This feature allows for tagging issues with relevant items for better tracking.

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Tag Issue with Item** | 1. When creating or editing an issue, select one or more items from the dropdown. | 1. The selected items are associated with the issue. <br> 2. The item names are displayed on the issue view page. |
| 2 | **Create New Item** | 1. If an item is not in the list, type the new item name and select it. | 1. A new entry is created in the `items` table. <br> 2. The new item is associated with the issue. |

## 12. UI & User Experience

This section covers application-wide UI features.

| # | Feature | Test Case | Expected Result |
|---|---|---|---|
| 1 | **Interconnected Filtering** | 1. In an issue view, filter the "Root Cause" list by a category. | 1. The root cause list is filtered. <br> 2. The "Action" list is automatically filtered to show only actions related to the selected root cause category. |
| 2 | **File Carousel** | 1. View the details of an action that has multiple files attached. | 1. The attached files are displayed in an interactive carousel, allowing the user to cycle through them. |
| 3 | **Theme Switching** | 1. Click the theme toggle switch in the application header. | 1. The application's theme switches between light and dark mode. <br> 2. The user's preference is saved for future sessions. |
