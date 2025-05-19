# 🚗 Online Car Rental System
**Database Systems Project**

## 🛠️ Technologies Used
- MySQL
- PHP
- HTML
- CSS

---

## 📚 Project Overview
This project involves the design and implementation of a database to manage a **Car Rental Company**. It focuses on storing and manipulating data related to cars, customers, rentals, and associated transactions.

---

## ✅ Tasks Achieved

### 1️⃣ Initial Data Loading
- Loaded sample data into the database using SQL scripts and/or loading programs.
- Designed reusable data files to simplify debugging and reloading.
- Defined custom data formats for consistency.

### 2️⃣ Data Retrieval & Reporting
- Queries implemented to retrieve and display:
  - Customers
  - Compact Cars
  - SUVs
  - Current Rentals
- Data presentation includes clear headings for readability.

### 3️⃣ Weekly Earnings Report
- Developed a query to generate weekly earnings:
  - By Owner
  - By Car Type
  - Per Car Unit

### 4️⃣ Database Transactions
Implemented the following using PHP:

- **Add a New Customer**
- **Add a New Car**
- **Create a Rental Reservation**  
  _(Automatically finds an available car of the selected type)_
- **Handle Car Returns**  
  _(Calculates total due and updates database)_
- **Update Rental Rates**  
  _(Daily and Weekly per car type)_

### 5️⃣ User-Friendly Interfaces
- All transactions feature interfaces for easy data entry:
  - Web-based Forms
  - Command-line Interface (optional)

### 6️⃣ Testing & Validation
- Added multiple:
  - Customers
  - Cars
  - Rental Reservations
- Performed updates to rental rates and verified behavior.

---

## 📐 Assumptions (EER Diagram)

- One customer rents one car at a time (1:1 cardinality).
- Cars are categorized into disjoint types (attribute: `type`).
- One owner can own multiple cars.
- Payments include security deposit, membership discounts, and optional chauffeur charges.
- Rentals can be **Daily** or **Weekly**.
- Return date is derived from start date and rental period.
- Feedback from customers is stored for service improvements.
- Customers can choose self-drive or chauffeur-driven options.

---

## 🧬 Relational Schema Mapping

- **CAR–OWNER** (1:N): Implemented via `OWNS` relation with foreign keys.
- **RENTAL** has subclasses:
  - `DAILY`
  - `WEEKLY`
  - Both include foreign keys referencing the main `RENTAL` table.
- **DRIVER** entity includes:
  - `CHAUFFEUR` (with driver assigned)
  - `SELF` (no driver)
- **CAR** type specialization handled using a single relation (Single Table Inheritance).
- All 1:1 relationships mapped using foreign keys.

📎 **Note:** The schema diagram is available in the project folder as `Schema_Diagram.pdf`.
