# Simple API for Book Lending

This API allows you to manage books and customers, as well as support the lending and returning of books.

## Endpoints

### 1. Book listing
**GET** `/api/books`

- **Description**: Returns a paginated book list (20 books per page) and an optional search filter.
- **Parameters**:
  - `search` (optional) – searches for books by name, author or customer name and surname.
  - `page` (optional) – page number.
- **Answer example**:
  ```json
  {
    "data": [
      {
        "id": 1,
        "title": "Example Book",
        "author": "Jan Kowalski",
        "is_borrowed": false,
        "client": null
      },
      {
        "id": 2,
        "title": "Other Book",
        "author": "Anna Nowak",
        "is_borrowed": true,
        "client": {
          "first_name": "Piotr",
          "last_name": "Nowak"
        }
      }
    ],
    "pagination": {
      "current_page": 1,
      "total_pages": 3
    }
  }
  ```
  ### 2. Book Details
  **GET** `/api/books/{id}`
  - **Description**: Returns details about a book, including name, author, year of publication, publisher, loan status, and customer information if the book is loaned.
  - **Answer example**:
  ```json
  {
  "id": 1,
  "title": "Example books",
  "author": "Jan Kowalski",
  "publication_year": 2020,
  "publisher": "Publishing house ABC",
  "is_borrowed": true,
  "client": {
    "first_name": "Piotr",
    "last_name": "Nowak"
  }
}
