    Book (10)
    - id (varchar 20 | PK)
    - Name (varchar 125)
    - Description (LONGTEXT)
    - Price (decimal 20)
    - Author_id (int 11 | FK)
    - Genre_id (int 11 | FK)
    - publisher_id (int 11 | FK)
    - Cover (varchar 255)
    - Qty (int 11)
    - Pages (int 11)
    - ISBN (int 20) (uk)
Author (x)
- ID (int 11)
- Name (varchar 100)
Genres
- ID (int 11)
- Name (varchar 100)
Publisher
- ID (int 11)
- Name (varchar 100)
User
- ID (int 11)
- Name (varchar 100)
- email (varchar 100) (UK)
- Username (varchar 100) (UK)
- Password (varchar 255)
- Role (50)
- active (int 11)
Cart
- ID (int 20)
- User_id (int 20)
- book_id (int 20)
- Price (decimal 20)
- qty (int 2)
Order
- ID (int 20)
- User_id (int 20)
~ Cart_id (int 11 | FK)
- Name (varchar 50)
- Phone numbers (varchar 10)
- Email (vc 50)
- Address (255)
- Address type (10)
- Method (50)
- bookid (20)
- price (10)
- qty (2)
- date
- status (55)

Orders
- id
- user_id
- book_id
- price
- qty
- date 

Address
- id
- user_id
- address_type
- address_1
- address_2
- city
- postal_code
- country

Payment
- id
- user_id
- order_id
- method
- card_num
- card_cvc
- expr_date