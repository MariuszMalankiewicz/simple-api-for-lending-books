# Simple API for Book Lending

This API allows you to manage books and customers, as well as support the lending and returning of books.

## Endpoints

### 1. Book listing
**GET** `/api/books`

- **Description**: Returns a paginated book list (20 books per page) and an optional search filter.
- **Parameters**:
  - `search` (optional) – searches for books by name, author or customer name and surname.
  - `page` (optional) – page number.
- **Default Example Response**:
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "title": "Rem in accusamus quas.",
            "author": "Prof. Missouri Collier DVM",
            "publication_year": "1970",
            "publisher": "Crooks Inc",
            "is_borrowed": true,
            "client_id": 2,
            "created_at": "2024-11-04T16:17:22.000000Z",
            "updated_at": "2024-11-04T18:30:12.000000Z",
            "client": {
                "id": 2,
                "first_name": "Lora",
                "last_name": "Lumbus",
                "created_at": "2024-11-04T18:29:09.000000Z",
                "updated_at": "2024-11-04T18:29:09.000000Z"
            }
        },
        {
            "id": 2,
            "title": "Accusantium in magnam.",
            "author": "Sammie Berge V",
            "publication_year": "1995",
            "publisher": "Hodkiewicz, Ward and Klocko",
            "is_borrowed": false,
            "client_id": null,
            "created_at": "2024-11-04T16:17:22.000000Z",
            "updated_at": "2024-11-04T16:17:22.000000Z",
            "client": null
        },
    ]
}
```


**GET** `/api/books?search=lor`
- **Example Response with search parameters**:
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "title": "Rem in accusamus quas.",
            "author": "Prof. Missouri Collier DVM",
            "publication_year": "1970",
            "publisher": "Crooks Inc",
            "is_borrowed": true,
            "client_id": 2,
            "created_at": "2024-11-04T16:17:22.000000Z",
            "updated_at": "2024-11-04T18:30:12.000000Z",
            "client": {
                "id": 2,
                "first_name": "Lora",
                "last_name": "Lumbus",
                "created_at": "2024-11-04T18:29:09.000000Z",
                "updated_at": "2024-11-04T18:29:09.000000Z"
            }
        }
    ]
}
```

**GET** `/api/books?page=2`
- **Example Response with page parameters**:
```json
{
    "current_page": 2,
    "data": [
        {
            "id": 21,
            "title": "Necessitatibus incidunt.",
            "author": "Sonia McCullough",
            "publication_year": "2005",
            "publisher": "Kozey-Pfannerstill",
            "is_borrowed": 0,
            "client_id": null,
            "created_at": "2024-11-04T16:17:22.000000Z",
            "updated_at": "2024-11-04T16:17:22.000000Z",
            "client": null
        },
        {
            "id": 22,
            "title": "Quia dignissimos unde necessitatibus.",
            "author": "Laurel Klocko",
            "publication_year": "2006",
            "publisher": "Kautzer Ltd",
            "is_borrowed": 0,
            "client_id": null,
            "created_at": "2024-11-04T16:17:22.000000Z",
            "updated_at": "2024-11-04T16:17:22.000000Z",
            "client": null
        }
    ]
}
```

### 2. Book Details
**GET** `/api/books/{id}`
- **Description**: Returns details about a book, including name, author, year of publication, publisher, loan status, and customer information if the book is loaned.
- **Example Response**:
```json
{
    "id": 1,
    "title": "Rem in accusamus quas.",
    "author": "Prof. Missouri Collier DVM",
    "publication_year": "1970",
    "publisher": "Crooks Inc",
    "is_borrowed": 1,
    "client_id": 2,
    "created_at": "2024-11-04T16:17:22.000000Z",
    "updated_at": "2024-11-04T18:30:12.000000Z",
    "client": {
        "id": 2,
        "first_name": "Lora",
        "last_name": "Lumbus",
        "created_at": "2024-11-04T18:29:09.000000Z",
        "updated_at": "2024-11-04T18:29:09.000000Z"
    }
}
```

### 3. List Clients
**GET** `/api/clients`
- **Description**: Returns a list of clients with their first and last names.
- **Example Response**:
```json
[
    {
        "id": 1,
        "first_name": "Peter",
        "last_name": "Brown"
    },
    {
        "id": 2,
        "first_name": "Anna",
        "last_name": "Johnson"
    }
]
```

### 4. Client Details
**GET** `/api/clients/{id}`
- **Description**: Returns client details, including first name, last name, and a list of borrowed books.
- **Example Response**:
```json
{
    "id": 2,
    "first_name": "Lora",
    "last_name": "Lumbus",
    "created_at": "2024-11-04T18:29:09.000000Z",
    "updated_at": "2024-11-04T18:29:09.000000Z",
    "books": [
        {
            "id": 1,
            "title": "Rem in accusamus quas.",
            "author": "Prof. Missouri Collier DVM",
            "publication_year": "1970",
            "publisher": "Crooks Inc",
            "is_borrowed": 1,
            "client_id": 2,
            "created_at": "2024-11-04T16:17:22.000000Z",
            "updated_at": "2024-11-04T18:30:12.000000Z"
        }
    ]
}
```

### 5. Add Client
**GET** `/api/clients`
- **Description**: Adds a new client.
- **Input Data**:
```json
{
  "first_name": "Adam",
  "last_name": "Smith"
}
```

- **Example Response**:
```json
{
    "first_name": "Adam",
    "last_name": "Smith",
    "updated_at": "2024-11-04T18:41:00.000000Z",
    "created_at": "2024-11-04T18:41:00.000000Z",
    "id": 3
}
```

### 6. Delete Client
**GET** `/api/clients/{id}`
- **Description**: Deletes a client by ID.
- **Example Response**:
```json
{
  "success": "Client deleted"
}
```

### 7. Borrow Book
**GET** `/api/books/{id}/borrow`
- **Description**: Borrows a book for the specified client.
- **Input Data**:
```json
{
  "client_id": 1
}
```

- **Example Response**:
```json
{
  "success": "Book borrowed successfully"
}
```

### 8. Return Book
**GET** `/api/books/{id}/return`
- **Description**: Returns a book to the library.
- **Example Response**:
```json
{
  "success": "Book returned successfully"
}
```



