# FLEXMONEY YOGA ADMISSION FORM

This project implements an online admission form for enrolling in monthly Yoga classes. It allows users to input their details, select a batch, and submit the form. The solution is built using HTML, CSS, JavaScript, and PHP for the backend to handle user data and API requests.

* Website URL :
http://flexmoneyyoga.infinityfreeapp.com/

* Requirements:
- Age Limit: Only individuals aged between 18-65 can enroll.
- Monthly Payment: The fee is ₹500 INR per month, and payment can be made at any time during the month.
- Batch Selection: There are four available batches per day:
6-7 AM
7-8 AM
8-9 AM
5-6 PM
- Batch Switching: Participants can switch batches from one month to the next, but must stick to one batch for the duration of each month.

* Technologies Used:
- Frontend: HTML, CSS, JavaScript
- Backend: PHP 
- Database: MySQL

* Features:
- User Form: Collects personal information including name, age, email, phone number, and batch selection.
- Validation: Ensures that users meet the requirements and submit valid data.
- Payment Simulation: Uses a mock function CompletePayment() to simulate the payment process (located in payment.php).
- Database Integration: Stores user data in a MySQL database.
- API: Simple PHP backend API that accepts data from the frontend, performs validations, stores data and returns results based on the payment function.

* Database Design
1. users_details(id, name, email, age, phone, created_at)
2. registration(id, user_id, batch_time, month_year, accepted_terms, created_at)
3. payments_details(id, user_id, amount, payment_date, status)

* Assumptions:
- Users will submit the required data in the form.
- The data will be sent to JavaScript, which will make a call to the PHP API.
- The API will store the data in the MySQL database and return the response to the frontend.
- Upon receiving the response, a success message will be displayed.

* Additional Features:
- Checkbox to confirm agreement with the Terms & Conditions
- Guidelines for users
- Field Validation for all input fields
- Fully responsive design for different screen sizes
- Success Message using SweetAlert
- Implemented protection against SQL injection

