# Gemba Digital API Documentation

This document provides details about the API endpoints available in the Gemba Digital application.

## Authentication

All API endpoints require an API key for authentication. The key must be provided in the `X-API-KEY` header of each request.

**Header:**
```
X-API-KEY: your_api_key_here
```

If the API key is missing or invalid, the server will respond with a `401 Unauthorized` error.

```json
{
    "error": "Unauthorized"
}
```

---

## Issue Files API

Base URL: `/api/issue/files`

### Upload Issue Files

Uploads one or more files associated with a specific issue.

- **URL:** `/upload`
- **Method:** `POST`
- **Content-Type:** `multipart/form-data`

**Form Data:**

| Parameter  | Type    | Description                                      |
|------------|---------|--------------------------------------------------|
| `issue_id` | integer | **Required.** The ID of the issue.               |
| `user_id`  | integer | **Required.** The ID of the user uploading the file. |
| `files[]`  | file[]  | **Required.** An array of files to upload. Allowed types: `jpeg,png,jpg,gif,mp4,mov,avi,webm`. Max size: 20MB. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Issue Files were succesfully uploaded",
    "data": {
        "files": [
            {
                "issue_id": "1",
                "user_id": "1",
                "type": "PHOTO",
                "path": "uploads/issue/1/668b8b8b8b8b8_abcdefghij.jpg",
                "updated_at": "2024-07-08T08:00:00.000000Z",
                "created_at": "2024-07-08T08:00:00.000000Z",
                "id": 1
            }
        ]
    }
}
```

**Error Response (400 Bad Request):**

```json
{
    "error": "Validation error message here"
}
```

### Get Issue Files

Retrieves a list of files for a specific issue.

- **URL:** `/get/{issue_id}`
- **Method:** `GET`

**URL Parameters:**

| Parameter  | Type    | Description                        |
|------------|---------|------------------------------------|
| `issue_id` | integer | **Required.** The ID of the issue. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Issue File list fetched successfully",
    "data": {
        "issue_id": "1",
        "files": [
            {
                "id": 1,
                "user_id": 1,
                "type": "PHOTO",
                "path": "uploads/issue/1/668b8b8b8b8b8_abcdefghij.jpg"
            }
        ]
    }
}
```

**Error Response (400 Bad Request):**

```json
{
    "status": "400",
    "message": "Please attach issue_id ",
    "data": []
}
```

### Delete Issue File

Deletes a specific issue file by its ID.

- **URL:** `/delete/{file_id}`
- **Method:** `DELETE`

**URL Parameters:**

| Parameter | Type    | Description                      |
|-----------|---------|----------------------------------|
| `file_id` | integer | **Required.** The ID of the file. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Issue File has been deleted",
    "data": []
}
```

**Error Response (400 Bad Request):**

```json
{
    "status": "400",
    "message": "Issue File not found",
    "data": []
}
```

---

## Root Cause Files API

Base URL: `/api/root-cause/files`

### Upload Root Cause Files

Uploads one or more files associated with a specific root cause.

- **URL:** `/upload`
- **Method:** `POST`
- **Content-Type:** `multipart/form-data`

**Form Data:**

| Parameter  | Type    | Description                                      |
|------------|---------|--------------------------------------------------|
| `cause_id` | integer | **Required.** The ID of the root cause.          |
| `user_id`  | integer | **Required.** The ID of the user uploading the file. |
| `files[]`  | file[]  | **Required.** An array of files to upload. Allowed types: `jpeg,png,jpg,gif,mp4,mov,avi,webm`. Max size: 20MB. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Root Cause Files were succesfully uploaded",
    "data": {
        "files": [
            {
                "root_cause_id": "1",
                "user_id": "1",
                "type": "PHOTO",
                "path": "uploads/root-cause/1/668b8b8b8b8b8_abcdefghij.jpg",
                "updated_at": "2024-07-08T08:00:00.000000Z",
                "created_at": "2024-07-08T08:00:00.000000Z",
                "id": 1
            }
        ]
    }
}
```

### Get Root Cause Files

Retrieves a list of files for a specific root cause.

- **URL:** `/get/{cause_id}`
- **Method:** `GET`

**URL Parameters:**

| Parameter  | Type    | Description                           |
|------------|---------|---------------------------------------|
| `cause_id` | integer | **Required.** The ID of the root cause. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Root Cause File list fetched successfully",
    "data": {
        "cause_id": "1",
        "files": [
            {
                "id": 1,
                "user_id": 1,
                "type": "PHOTO",
                "path": "uploads/root-cause/1/668b8b8b8b8b8_abcdefghij.jpg"
            }
        ]
    }
}
```

### Delete Root Cause File

Deletes a specific root cause file by its ID.

- **URL:** `/delete/{file_id}`
- **Method:** `DELETE`

**URL Parameters:**

| Parameter | Type    | Description                      |
|-----------|---------|----------------------------------|
| `file_id` | integer | **Required.** The ID of the file. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Root Cause File has been deleted",
    "data": []
}
```

---

## Action Completion Files API

Base URL: `/api/action/completion/files`

### Upload Action Completion Files

Uploads one or more evidence files for a completed action.

- **URL:** `/upload`
- **Method:** `POST`
- **Content-Type:** `multipart/form-data`

**Form Data:**

| Parameter   | Type    | Description                                      |
|-------------|---------|--------------------------------------------------|
| `appreciation_note_id` | integer | **Required.** The ID of the action.              |
| `user_id`   | integer | **Required.** The ID of the user uploading the file. |
| `files[]`   | file[]  | **Required.** An array of files to upload. Allowed types: `jpeg,png,jpg,gif,mp4,mov,avi,webm`. Max size: 20MB. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Action Completion Files were succesfully uploaded",
    "data": {
        "files": [
            {
                "appreciation_note_id": "1",
                "user_id": "1",
                "type": "PHOTO",
                "path": "uploads/action/completion/1/668b8b8b8b8b8_abcdefghij.jpg",
                "updated_at": "2024-07-08T08:00:00.000000Z",
                "created_at": "2024-07-08T08:00:00.000000Z",
                "id": 1
            }
        ]
    }
}
```

### Get Action Completion Files

Retrieves a list of evidence files for a specific action.

- **URL:** `/get/{appreciation_note_id}`
- **Method:** `GET`

**URL Parameters:**

| Parameter   | Type    | Description                         |
|-------------|---------|-------------------------------------|
| `appreciation_note_id` | integer | **Required.** The ID of the action. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Action Completion File list fetched successfully",
    "data": {
        "appreciation_note_id": "1",
        "files": [
            {
                "id": 1,
                "user_id": 1,
                "type": "PHOTO",
                "path": "uploads/action/completion/1/668b8b8b8b8b8_abcdefghij.jpg"
            }
        ]
    }
}
```

### Delete Action Completion File

Deletes a specific action completion file by its ID.

- **URL:** `/delete/{file_id}`
- **Method:** `DELETE`

**URL Parameters:**

| Parameter | Type    | Description                      |
|-----------|---------|----------------------------------|
| `file_id` | integer | **Required.** The ID of the file. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Action completion File has been deleted",
    "data": []
}
```

---

## Appreciation Note Files API

Base URL: `/api/action/completion/files`

### Upload Appreciation Note Files

Uploads one or more evidence files for a completed action.

- **URL:** `/upload`
- **Method:** `POST`
- **Content-Type:** `multipart/form-data`

**Form Data:**

| Parameter   | Type    | Description                                      |
|-------------|---------|--------------------------------------------------|
| `appreciation_note_id` | integer | **Required.** The ID of the action.              |
| `user_id`   | integer | **Required.** The ID of the user uploading the file. |
| `files[]`   | file[]  | **Required.** An array of files to upload. Allowed types: `jpeg,png,jpg,gif,mp4,mov,avi,webm`. Max size: 20MB. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Appreciation Note Files were succesfully uploaded",
    "data": {
        "files": [
            {
                "appreciation_note_id": "1",
                "user_id": "1",
                "type": "PHOTO",
                "path": "uploads/action/completion/1/668b8b8b8b8b8_abcdefghij.jpg",
                "updated_at": "2024-07-08T08:00:00.000000Z",
                "created_at": "2024-07-08T08:00:00.000000Z",
                "id": 1
            }
        ]
    }
}
```

### Get Appreciation Note Files

Retrieves a list of evidence files for a specific action.

- **URL:** `/get/{appreciation_note_id}`
- **Method:** `GET`

**URL Parameters:**

| Parameter   | Type    | Description                         |
|-------------|---------|-------------------------------------|
| `appreciation_note_id` | integer | **Required.** The ID of the action. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Appreciation Note File list fetched successfully",
    "data": {
        "appreciation_note_id": "1",
        "files": [
            {
                "id": 1,
                "user_id": 1,
                "type": "PHOTO",
                "path": "uploads/action/completion/1/668b8b8b8b8b8_abcdefghij.jpg"
            }
        ]
    }
}
```

### Delete Appreciation Note File

Deletes a specific Appreciation Note file by its ID.

- **URL:** `/delete/{file_id}`
- **Method:** `DELETE`

**URL Parameters:**

| Parameter | Type    | Description                      |
|-----------|---------|----------------------------------|
| `file_id` | integer | **Required.** The ID of the file. |

**Success Response (200 OK):**

```json
{
    "status": "200",
    "message": "Appreciation Note File has been deleted",
    "data": []
}
```
---

## User Profile Photo API

Base URL: `/api/user/photos/profile`

---

### 📤 Upload Profile Photo

**Endpoint:**
`POST /upload`

**Description:**
Upload one or more profile photos for a specific user.

**Headers:**
`Content-Type: multipart/form-data`

**Body Parameters (form-data):**

| Field    | Type    | Required | Description                                                  |
| -------- | ------- | -------- | ------------------------------------------------------------ |
| user\_id | integer | ✅ Yes    | The ID of the user                                           |
| files\[] | file\[] | ✅ Yes    | One or more image files (jpeg, png, jpg, gif). Max 20MB each |

**Response Example:**

```json
{
  "status": "200",
  "message": "Profile Photo were succesfully uploaded",
  "data": {
    "files": [
      {
        "id": 5,
        "user_id": 1,
        "type": "PHOTO",
        "path": "uploads/user/profile/1/62ff9d_image123.jpg",
        "created_at": "2025-07-19T12:00:00Z",
        "updated_at": "2025-07-19T12:00:00Z"
      }
    ]
  }
}
```

---

### 📥 Get Latest Profile Photo

**Endpoint:**
`GET /get/{user_id}`

**Description:**
Retrieve the latest uploaded profile photo for a given user.

**URL Parameter:**

| Param    | Type    | Required | Description    |
| -------- | ------- | -------- | -------------- |
| user\_id | integer | ✅ Yes    | ID of the user |

**Response Example:**

```json
{
  "status": "200",
  "message": "Profile Photo fetched successfully",
  "data": {
    "user_id": 1,
    "file": [
      {
        "id": 5,
        "user_id": 1,
        "type": "PHOTO",
        "path": "uploads/user/profile/1/62ff9d_image123.jpg"
      }
    ]
  }
}
```

---

### 🗑️ Delete Profile Photo

**Endpoint:**
`DELETE /delete/{file_id}`

**Description:**
Delete a specific uploaded profile photo by its ID.

**URL Parameter:**

| Param    | Type    | Required | Description              |
| -------- | ------- | -------- | ------------------------ |
| file\_id | integer | ✅ Yes    | ID of the file to delete |

**Response Example (Success):**

```json
{
  "status": "200",
  "message": "profile photo has been deleted",
  "data": []
}
```

**Response Example (Failure):**

```json
{
  "status": "400",
  "message": "File not found",
  "data": []
}
```


---

## User Profile Photo API

Base URL: `/api/user/photos/cover`

---

### 📤 Upload Cover Photo

**Endpoint:**
`POST /upload`

**Description:**
Upload one or more cover photos for a specific user.

**Headers:**
`Content-Type: multipart/form-data`

**Body Parameters (form-data):**

| Field    | Type    | Required | Description                                                  |
| -------- | ------- | -------- | ------------------------------------------------------------ |
| user\_id | integer | ✅ Yes    | The ID of the user                                           |
| files\[] | file\[] | ✅ Yes    | One or more image files (jpeg, png, jpg, gif). Max 20MB each |

**Response Example:**

```json
{
  "status": "200",
  "message": "Cover Photo were succesfully uploaded",
  "data": {
    "files": [
      {
        "id": 5,
        "user_id": 1,
        "type": "PHOTO",
        "path": "uploads/user/cover/1/62ff9d_image123.jpg",
        "created_at": "2025-07-19T12:00:00Z",
        "updated_at": "2025-07-19T12:00:00Z"
      }
    ]
  }
}
```

---

### 📥 Get Latest Cover Photo

**Endpoint:**
`GET /get/{user_id}`

**Description:**
Retrieve the latest uploaded cover photo for a given user.

**URL Parameter:**

| Param    | Type    | Required | Description    |
| -------- | ------- | -------- | -------------- |
| user\_id | integer | ✅ Yes    | ID of the user |

**Response Example:**

```json
{
  "status": "200",
  "message": "Cover Photo fetched successfully",
  "data": {
    "user_id": 1,
    "file": [
      {
        "id": 5,
        "user_id": 1,
        "type": "PHOTO",
        "path": "uploads/user/cover/1/62ff9d_image123.jpg"
      }
    ]
  }
}
```

---

### 🗑️ Delete Cover Photo

**Endpoint:**
`DELETE /delete/{file_id}`

**Description:**
Delete a specific uploaded cover photo by its ID.

**URL Parameter:**

| Param    | Type    | Required | Description              |
| -------- | ------- | -------- | ------------------------ |
| file\_id | integer | ✅ Yes    | ID of the file to delete |

**Response Example (Success):**

```json
{
  "status": "200",
  "message": "cover photo has been deleted",
  "data": []
}
```

**Response Example (Failure):**

```json
{
  "status": "400",
  "message": "File not found",
  "data": []
}
```

